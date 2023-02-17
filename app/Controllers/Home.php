<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(){
        $session = session();
        
        $header['title']='Home';
        
        $header['user']=$session->get('user');

        //if user if not logged in
        return view('templates/header', $header)
            . view('templates/welcome')
            . view('templates/footer');

        
    }

    
}
