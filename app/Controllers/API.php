<?php

    namespace App\Controllers;
    use App\Models\FootballCompetitionModel;
    use App\Models\FootballVenueModel;
    use App\Models\FootballTeamModel;

    class API extends BaseController{



        public function loadCompetition($id)
        {
            
            // Check if the competition is in the database if not load it 
            
            echo "TEST";
            // $venueModel = model(FootballVenueModel::class);

            // $venueModel->upsert(
            // [
            //     'id' => $venue->id,
            //     'name'  => $venue->name,
            //     'address'  => $venue->address,
            //     'city'  => $venue->city,
            //     'capacity'  => $venue->capacity,
            //     'image'  => $venue->image,
            // ]);

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
    }
?>