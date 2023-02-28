<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(){
        $session = session();
        
        $header['title']='Home';
        $header['user']=$session->get('user');
        
        if(isset($_POST["data"])){
            print("DPOST");
            echo($_POST["response"]);
        }
        
        //if user if not logged in
        return view('templates/header', $header)
            . view('templates/welcome')
            . view('templates/footer');

        
    }

    public function load(){

        //F1
        // $model = model(F1Model::class);

        // if(isset($_POST["data"])){
        //     $responseArray = $_POST["data"];
        //     for ($x = 0; $x < sizeof($_POST["data"]); $x++) {
        //         $team =([
        //             'id' => $responseArray[$x]['team']['id'],
        //             'name' => $responseArray[$x]['team']['name'],
        //             'logo'=> $responseArray[$x]['team']['logo'],
        //             'points' => 0,
        //         ]);

        //         $model->setTeam($team);
        //     }
        // }

        //SERIE A
        
    }

    
}
