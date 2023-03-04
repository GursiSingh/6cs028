<?php

    namespace App\Controllers;
    use App\Models\FootballCompetitionModel;
    use App\Models\FootballVenueModel;
    use App\Models\FootballTeamModel;
    use App\Models\FootballPlayerModel;
    use App\Models\FootballFixtureModel;

    class API extends BaseController{


        //fetch Competition and store it into the database, and fetch data of all teams in the competitions 
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

                for($x = 0; $x <= sizeof($standings); $x++){
                    $teamName = $standings[$x]->team->id;
                    $points = $standings[$x]->points;

                    $this->loadTeam($teamName, $id, $points);
                }
            }
            
            
        }

        //fetch team and store it into the database
        public function loadTeam($id, $competitionId, $points){

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
                $teamModel = model(FootballTeamModel::class);
    
                $teamModel->setTeam($team, $points, $venue, $competitionId);
            }
            


        }

        //Fetch players of a team and store them in the database
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
        }

        //Load Footaball Fixtures
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

            for($i = 0; $i < $result->results;$i++){

                $fixture = $result->response[$i];
                $id = $fixture->fixture->id;
                $date = $fixture->fixture->date;
                $venueId = $fixture->fixture->venue->id;
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
        }

        //Set Current Fixtures Rouond
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
            print_r($result);
            $fixtureModel->setCurrentRound($competitionId, $result->response[0]);
                    
        }
    
    }
?>