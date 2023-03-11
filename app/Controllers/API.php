<?php

    namespace App\Controllers;
    use App\Models\FootballCompetitionModel;
    use App\Models\FootballVenueModel;
    use App\Models\FootballTeamModel;
    use App\Models\FootballPlayerModel;
    use App\Models\FootballFixtureModel;
    
    use App\Models\F1Model;
    use App\Models\F1DriverModel;
    use App\Models\F1EventModel;
    use App\Models\F1CircuitModel;
    use App\Models\F1RankingModel;

    class API extends BaseController{

        /*==== FOOTBALL ====*/
        //fetch Competition and store it into the database, and fetch data of all teams in the competitions - Twice a Year
        public function loadCompetition($id)
        {
            
            // Check if the competition is in the database if not load it 
            $client = \Config\Services::curlrequest();

            $response = $client->request('GET', 'https://v3.football.api-sports.io/standings?league='.$id.'&season=2022', [
                'headers' => [
                    'x-rapidapi-key' => ' c6e2eba6888143bbe4a8e8ae1160a59a',
                    'x-rapidapi-host' => 'v3.football.api-sports.io',
                ], 'delay' => 2000,
            ]);
            $result = json_decode($response->getBody());

            echo '<pre>';
            print_r($result);
            echo '</pre>';
            
            if(sizeof($result->response) == 1){
                $competition = $result->response[0]->league;
            
                //Load Competition to DB
                $competitionModel = model(FootballCompetitionModel::class);

                $competitionModel->setCompetition($competition);

                $standings = $competition->standings[0];

                for($x = 0; $x < sizeof($standings); $x++){
                    $teamName = $standings[$x]->team->id;
                    $points = $standings[$x]->points;

                    $this->loadTeam($teamName, $id, $points);
                }
            }
            return;
            
            
        }

        //fetch team and store it into the database -Twice a Year
        public function loadTeam($id, $competitionId, $points){
            
            //team Model
            $teamModel = model(FootballTeamModel::class);
            //check if team is already in the database
            $team = $teamModel->getTeam($id);
            if(empty($team))
            {
                $client = \Config\Services::curlrequest();

                $response = $client->request('GET', 'https://v3.football.api-sports.io/teams?id='.$id, [
                    'headers' => [
                        'x-rapidapi-key' => ' c6e2eba6888143bbe4a8e8ae1160a59a',
                        'x-rapidapi-host' => 'v3.football.api-sports.io',
                    ]
                ]);

                $result = json_decode($response->getBody());
                if(sizeof($result->response) == 1){

                    $team = $result->response[0]->team;
                    $venue = $result->response[0]->venue;
                    
                    //store venue
                    //id, name, address, city, capacity, image
                    //Load Competition to DB
                    $venueModel = model(FootballVenueModel::class);
        
                    $venueModel->setVenue($venue);

                    sleep(3);
        
                    //store team
                    //id, name, code, league_competition, logo, founded, points, venue
        
                    $teamModel->setTeam($team, $points, $venue, $competitionId);
                }
            }else{
                //Update Team Points
                $teamModel->updateTeamPoints($competitionId, $id, $points);
            }
            return;
        }

        //Fetch players of a team and store them in the database -Twice a Year
        public function loadTeamPlayers($teamId){
            $client = \Config\Services::curlrequest();

            $response = $client->request('GET', 'https://v3.football.api-sports.io/players/squads?team='.$teamId, [
                'headers' => [
                    'x-rapidapi-key' => ' c6e2eba6888143bbe4a8e8ae1160a59a',
                    'x-rapidapi-host' => 'v3.football.api-sports.io',
                ]
            ]);

            $result = json_decode($response->getBody());
            if(sizeof($result->response) == 1){

                $players = $result->response[0]->players;

                echo "Number of Players: ".sizeOf($players);
                //Load Player to DB
                $playerModel = model(FootballPlayerModel::class);

                for($i = 0; $i < sizeOf($players); $i++){

                    $playerModel->setPlayer($players[$i], $teamId);
                }
                
            }
            return;
        }

        //Load Footaball Fixtures - Daily
        public function loadFixtures($competitionId){

            $client = \Config\Services::curlrequest();

            $response = $client->request('GET', 'https://v3.football.api-sports.io/fixtures?league='.$competitionId.'&season=2022', [
                'headers' => [
                    'x-rapidapi-key' => ' c6e2eba6888143bbe4a8e8ae1160a59a',
                    'x-rapidapi-host' => 'v3.football.api-sports.io',
                ]
            ]);

            $result = json_decode($response->getBody());
            //id, home, away, time, venue, status, goalHome, goalAway, winnerId, round, current, competitionId
            $fixtureModel = model(FootballFixtureModel::class);
            print_r($result);
            for($i = 0; $i < $result->results;$i++){

                $fixture = $result->response[$i];
                $id = $fixture->fixture->id;
                $date = $fixture->fixture->date;
                $venueId = $fixture->fixture->venue->id;
                //check if venue is in the database
                $venueModel = model(FootballVenueModel::class);
                
                if($venueId != null){
                    if(empty($venueModel->getVenue($venueId))){
                        $venue = [
                            'id' => $venueId,
                            'name'  =>  $fixture->fixture->venue->name,
                            'city'  =>  $fixture->fixture->venue->city,
                        ];
                        $venueModel->setTempVenue($venue);
                    }
                }else{
                    $venueId = null;
                }
                

                //Check if team is in the database

                $status = $fixture->fixture->status->short;
                $homeTeam = $fixture->teams->home->id;
                $awayTeam = $fixture->teams->away->id;

                if($fixture->teams->home->winner){
                    $winnerId = $homeTeam;
                }else if($fixture->teams->away->winner){
                    $winnerId = $awayTeam;
                }else{
                    $winnerId = null;
                }

                $goalHome  = $fixture->goals->home;
                $goalAway  = $fixture->goals->away;

                $round = $fixture->league->round;
                $current = false;

                //Check if teams are in database
                $this->setTempTeam($fixture->teams->home, $venueId);
                $this->setTempTeam($fixture->teams->away, null);
                
                $data = [
                    'id' => $id,
                    'home'  => $homeTeam,
                    'away'  => $awayTeam,
                    'date'  => $date,
                    'competitionId'  => $competitionId,
                    'goal_away'  => $goalAway,
                    'goal_home'  => $goalHome,
                    'status'  => $status,
                    'venueId'  => $venueId,
                    'winnerId'  => $winnerId,
                    'current'  => $current,
                    'round'  => $round,
                ];

                //Load Fixture to DB
                $fixtureModel->setFixture($data);

                
            }          
            $this->setCurrentRound($competitionId);
            return;
        }


        //Set Temporary Team
        public function setTempTeam($team, $venue=null){
            $id = $team->id;
            //team Model
            $teamModel = model(FootballTeamModel::class);
            if(empty($teamModel->getTeam($id))){
                $teamModel->setTempTeam($team, $venue);
            }
            
        }

        //Set Current Fixtures Round - Daily   
        public function setCurrentRound($competitionId){

            $client = \Config\Services::curlrequest();

            $response = $client->request('GET', 'https://v3.football.api-sports.io/fixtures/rounds?league='.$competitionId.'&season=2022&current=true', [
                'headers' => [
                    'x-rapidapi-key' => ' c6e2eba6888143bbe4a8e8ae1160a59a',
                    'x-rapidapi-host' => 'v3.football.api-sports.io',
                ]
            ]);

            $result = json_decode($response->getBody());
            //id, home, away, time, venue, status, goalHome, goalAway, winnerId, round, current, competitionId
            $fixtureModel = model(FootballFixtureModel::class);
            
            $fixtureModel->setCurrentRound($competitionId, $result->response[0]);
            return;
                    
        }

        /*==== F1 ====*/
        //Load F1 Teams
        public function loadF1Teams()
        {
            $client = \Config\Services::curlrequest();

            $response = $client->request('GET', 'https://v1.formula-1.api-sports.io/rankings/teams?season=2023', [
                'headers' => [
                    'x-rapidapi-key' => ' c6e2eba6888143bbe4a8e8ae1160a59a',
                    'x-rapidapi-host' => 'v3.football.api-sports.io',
                ]
            ]);
            $result = json_decode($response->getBody());
            
            //id //name //logo //points
            
            $model = model(F1Model::class);
            for($i = 0; $i <= $result->results; $i++){

                $id = $result->response[$i]->team->id;
                $f1Team = $model->getTeam($id);
                
                if(!empty($f1Team)){

                    $name = $result->response[$i]->team->name;
                    $logo = $result->response[$i]->team->logo;
                    $points = $result->response[$i]->points;

                    $teamResponse = $client->request('GET', 'https://v1.formula-1.api-sports.io/teams?id='.$id, [
                        'headers' => [
                            'x-rapidapi-key' => ' c6e2eba6888143bbe4a8e8ae1160a59a',
                            'x-rapidapi-host' => 'v1.formula-1.api-sports.io',
                        ]
                    ]);


                    $teamResult = json_decode($teamResponse->getBody());
                    $worldChampionships = $teamResult->response[0]->world_championships;
                    $base = $teamResult->response[0]->base;
                    $firstEntry = $teamResult->response[0]->first_team_entry;
                    $president = $teamResult->response[0]->president;
                    $director = $teamResult->response[0]->director;
                    $chassis = $teamResult->response[0]->chassis;


                    $team = [

                        'id'    =>  $id,
                        'name'  =>  $name,
                        'logo'  =>  $logo,
                        'world_championships'   =>  $worldChampionships,
                        'base'  =>  $base,
                        'first_entry'    => $firstEntry,
                        'president'  => $president,
                        'director'  =>  $director,
                        'chassis'   =>  $chassis,
                        'points'    =>  $points,

                    ];
                    $model->setTeam($team);

                }
                

            }
                   
        }

        // Load F1 Drivers
        public function loadF1Drivers(){
            $client = \Config\Services::curlrequest();

            $response = $client->request('GET', 'https://v1.formula-1.api-sports.io/rankings/drivers?season=2023', [
                'headers' => [
                    'x-rapidapi-key' => ' c6e2eba6888143bbe4a8e8ae1160a59a',
                    'x-rapidapi-host' => 'v1.formula-1.api-sports.io',
                ]
            ]);
            $result = json_decode($response->getBody());

            $driverModel = model(F1DriverModel::class);
            for($i = 0; $i < $result->results; $i++){
                
                $response = $result->response[$i];
                $points = $response->points;
                if($points == null){
                    $points = 0;
                }
                $driver = [

                    'id'    =>  $response->driver->id,
                    'name'  =>  $response->driver->name,
                    'abbr'  =>  $response->driver->abbr,
                    'image'   =>  $response->driver->image,
                    'number'  =>  $response->driver->number,
                    'team'    => $response->team->id,
                    'points'    =>  $points,

                ];

                $driverModel->setDriver($driver);
            }
        }

        // Load F1 Circuits
        public function loadF1Races(){
            $client = \Config\Services::curlrequest();

            $response = $client->request('GET', 'https://v1.formula-1.api-sports.io/races?season=2023', [
                'headers' => [
                    'x-rapidapi-key' => ' c6e2eba6888143bbe4a8e8ae1160a59a',
                    'x-rapidapi-host' => 'v1.formula-1.api-sports.io',
                ]
            ]);
            $result = json_decode($response->getBody());

            $circuitModel = model(F1CircuitModel::class);
            $eventModel = model(F1EventModel::class);

            for($i = 0; $i < $result->results; $i++){
                
                $response = $result->response[$i];
                $circuitId = $response->circuit->id;

                $circuit = $circuitModel->getCircuit($circuitId);
                if(empty($circuit)){

                    $circuit = [
                        'id'    =>  $circuitId,
                        'name'  =>  $response->circuit->name,
                        'country'  =>  $response->competition->location->country,
                        'image'   =>  $response->circuit->image,
                        'distance'   =>  $response->distance,
                    ];

                    $circuitModel->setCircuit($circuit);

                }
            }

            for($i = 0; $i < $result->results; $i++){
                
                $response = $result->response[$i];
                $circuitId = $response->circuit->id;

                $event = [
                    'id'    =>  $response->id,
                    'circuitId'  =>  $circuitId,
                    'season'  =>  $response->season,
                    'type'   =>  $response->type,
                    'laps'   =>  $response->laps->total,
                    'date'   =>  $response->date,
                    'status'   =>  $response->status,

                ];
                $eventModel->setEvent($event);
            }
        }

        // Load Rankings of a F1 Race 
        public function loadF1RaceRanking($raceId){
            $client = \Config\Services::curlrequest();

            $response = $client->request('GET', 'https://v1.formula-1.api-sports.io/rankings/races?race='.$raceId, [
                'headers' => [
                    'x-rapidapi-key' => ' c6e2eba6888143bbe4a8e8ae1160a59a',
                    'x-rapidapi-host' => 'v1.formula-1.api-sports.io',
                ]
            ]);
            $result = json_decode($response->getBody());

            $rankingModel = model(F1RankingModel::class);
            $driverModel = model(F1DriverModel::class);
            for($i = 0; $i < $result->results; $i++){

                $response = $result->response[$i];
                $driverId = $response->driver->id;

                //Check if driver is stored
                $driver = $driverModel->getDriver($driverId);
                if(empty($driver)){
                    
                    $driver = [
                        'id'    =>  $response->driver->id,
                        'name'  =>  $response->driver->name,
                        'abbr'  =>  $response->driver->abbr,
                        'image'   =>  $response->driver->image,
                        'number'  =>  $response->driver->number,
                        'team'    => $response->team->id,
                        'points'    =>  0,
    
                    ];

                    $driverModel->setDriver($driver);
                }

                $rank = [

                    'race_id'    =>  $response->race->id,
                    'driver_id'  =>  $response->driver->id,
                    'team_id'  =>  $response->team->id,
                    'position'   =>  $response->position,
                    'time'  =>  $response->time,
                    'laps'    => $response->laps,
                    'pits'    =>  $response->pits,
                    'grid'    =>  $response->grid,
                ];

                $rankingModel->setRanking($rank);

            }


        }

        /***** UPDATE *****/
        //Update the competition if more than 12 hours has passed from the last update
        public function updateFootball($competitionId){
            //https://stackoverflow.com/questions/15228832/php-string-in-a-date-format-add-12-hours
            $competitionModel = model(FootballCompetitionModel::class);
            $date = new \DateTime($competitionModel->getLastUpdate($competitionId)['last_update']);
            $date->modify("+12 hours");
            $now = new \DateTime();
            print_r($date);
            if($now >= $date)
            {
                //Update Standings
                echo "updating";
                $this->loadCompetition($competitionId);
                //Update Fixtures
                $this->loadFixtures($competitionId);
            }
        }
    }
?>