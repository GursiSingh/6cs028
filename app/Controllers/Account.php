<?php

namespace App\Controllers;

class Account extends BaseController
{
    public function login(){

        $header['title']='Login';    

        //if user if not logged in
        return view('templates/header', $header)
            . view('account/login')
            . view('templates/footer');
    }
}
