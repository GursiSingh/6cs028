<?php

namespace App\Controllers;

class F1 extends BaseController{

    public function getF1Teams(){


        // $url = "https://v1.formula-1.api-sports.io/rankings/teams?season=2022";
        // $reqPrefs['https']['method'] = 'GET';
        // $reqPrefs['https']['header'] = 'x-rapidapi-key : c6e2eba6888143bbe4a8e8ae1160a59a,
        //                                 x-rapidapi-host : v1.formula-1.api-sports.io';
        
        // $stream_context = stream_context_create($reqPrefs);
        // $response = file_get_contents($url, false, $stream_context);
        // $jsonData = json_decode($response);
        
        // echo ($jsonData);

        
        $model = model(F1Model::class);
        $teams = $model->getTeams();


    }

}