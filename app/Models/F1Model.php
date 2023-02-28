<?php

namespace App\Models;

use CodeIgniter\Model;

class F1Model extends Model{

    protected $table = 'ci_f1teams';
    protected $allowedFields = ['id', 'name', 'logo','points'];

    public function setTeam($team)
    {
        // $client = new http\Client;
        // $request = new http\Client\Request;

        // $request->setRequestUrl('https://api-formula-1.p.rapidapi.com/rankings/teams');
        // $request->setRequestMethod('GET');
        // $request->setQuery(new http\QueryString(array(
        //     'season' => '2012'
        // )));

        // $request->setHeaders(array(
        //     'x-rapidapi-host' => 'api-formula-1.p.rapidapi.com',
        //     'x-rapidapi-key' => 'c6e2eba6888143bbe4a8e8ae1160a59a'
        // ));

        // $client->enqueue($request)->send();
        // $response = $client->getResponse();
        // print($response);
        // echo $response->getBody();        
        // $id
        // $name
        // $logo
        // $points = 0;
        $this->upsert($team);
    }


    public function getTeams($slug){
        return $this->like('name', $slug)->findAll();
        
    }
}