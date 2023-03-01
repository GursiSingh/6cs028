<?php

namespace App\Controllers;

class F1 extends BaseController{

    public function displayTeam($id){

        $model = model(F1Model::class);
        $team = $model->getTeam($id);

        return view('templates/header', $header)
            . view('f1/team')
            . view('templates/footer');
    }

}