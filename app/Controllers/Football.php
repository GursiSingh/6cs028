<?php

    namespace App\Controllers;
    use App\Models\FootballTeamModel;
    use App\Models\FootballCompetitionModel;
    use App\Models\FootballVenueModel;

    class Football extends BaseController
    {   
        public function index(){
            $session = session();

            $header['title']='Fooball Home';
            $header['user']=$session->get('user');
            $teamModel = model(FootballTeamModel::class);
            $competitionModel = model(FootballCompetitionModel::class);
            $fixtureModel = model(FootballFixtureModel::class);
            
            if(!empty($header['user'])){
                $team = $teamModel->getTeam($header['user']['football_team'])[0];
                $competition = $competitionModel->getCompetition($team['league_competition'])[0];
                $data['competitionId']= $competition['id'];
            }else{
                
                $data['competitionId']= null;
            }


            $todayMatches = $fixtureModel->getTodaysFixtures();

            for($i = 0; $i < sizeOf($todayMatches); $i++){
				
                $time = (new \DateTime($todayMatches[$i]['date']))->format('H:i'); 

				$todayMatches[$i]['homeName'] = $teamModel->getTeam($todayMatches[$i]['home'])[0]['name'];
				$todayMatches[$i]['homeCode'] = $teamModel->getTeam($todayMatches[$i]['home'])[0]['code'];
				$todayMatches[$i]['homeLogo'] = $teamModel->getTeam($todayMatches[$i]['home'])[0]['logo'];
				$todayMatches[$i]['awayName'] = $teamModel->getTeam($todayMatches[$i]['away'])[0]['name'];
				$todayMatches[$i]['awayLogo'] = $teamModel->getTeam($todayMatches[$i]['away'])[0]['logo'];
				$todayMatches[$i]['awayCode'] = $teamModel->getTeam($todayMatches[$i]['away'])[0]['code'];
                $competition = $competitionModel->getCompetition($todayMatches[$i]['competitionId'])[0];
				$todayMatches[$i]['competitionLogo'] = $competition['logo'];
				$todayMatches[$i]['competitionName'] = $competition['name'];
				$todayMatches[$i]['time'] = $time;
			}

            $data['todayFixtures'] = $todayMatches;
            return view('templates/header', $header)
                . view('football/index', $data)
                . view('templates/footer');
        }

        public function displayTeam($id){
            $session = session();
        
            

            $teamModel = model(FootballTeamModel::class);
            $competitionModel = model(FootballCompetitionModel::class);
            $fixtureModel = model(FootballFixtureModel::class);
            $venueModel = model(FootballVenueModel::class);
            
            $data['team'] = $teamModel->getTeam($id)[0];
            $compId = $data['team']['league_competition'];
            $venueId = $data['team']['venue'];
            $data['position'] = $teamModel->getTeamPosition($compId, $id);
            $data['competition'] = $competitionModel->getCompetition($compId)[0];
            $data['venue'] = $venueModel->getVenue($venueId)[0];
            $header['title']= $data['team']['name'];
            $header['user']=$session->get('user');

            return view('templates/header', $header)
                . view('football/team', $data)
                . view('templates/footer');
        }
    }

?>