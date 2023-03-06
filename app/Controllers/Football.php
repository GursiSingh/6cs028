<?php

    namespace App\Controllers;
    use App\Models\FootballTeamModel;
    use App\Models\FootballCompetitionModel;
    use App\Models\FootballVenueModel;

    class Football extends BaseController
    {
        public function displayTeam($id){
            $session = session();
        
            $header['title']='Team';
            $header['user']=$session->get('user');

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

            return view('templates/header', $header)
                . view('football/team', $data)
                . view('templates/footer');
        }
    }

?>