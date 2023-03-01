<?php

    namespace App\Controllers;
    use App\Models\FootballTeamModel;

    class Football extends BaseController
    {
        public function displayTeam($id){

            $model = model(FootballTeamModel::class);
            $team = $model->getTeam($id);
    
            return view('templates/header', $header)
                . view('football/team')
                . view('templates/footer');
        }
    }

?>