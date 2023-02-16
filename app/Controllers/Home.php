<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(){

        $header['title']='Home';    

        //if user if not logged in
        return view('templates/header', $header)
            . view('templates/welcome')
            . view('templates/footer');

        
    }

    
}
