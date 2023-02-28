<?php

namespace App\Controllers;

class User extends BaseController
{
    public function login(){
        helper('form');
        $session = session();

        $header['title']='Login';      
        $header['user']= null;      

        // Checks whether the form is submitted.
        if (!$this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/header', $header)
                . view('user/login')
                . view('templates/footer');
        }

        //If form is submitted
        //Get Data form the form
        $userInput = $this->request->getPost(['username', 'password']);
        
        $model = model(UserModel::class);
        //Check if the userName is present in the database
        $user = $model->getUser($userInput['username']);
        
        
        if($user['username'] != null){
            if($this->encryptPassword($userInput) == $user['password']){
                //log in
                
                $session->set('user',$user);
                return redirect('/');
            }
            
        }

        return view('templates/header', $header)
                . view('user/login')
                . view('templates/footer');
    }

    public function signUp(){

        helper('form');
        $session = session();

        $header['title']='Sign Up';
        $header['user']= null;    

        // Checks whether the form is submitted.
        if (!$this->request->is('post')) {
            // The form is not submitted, so returns the form.
            //if user if not logged in
            return view('templates/header', $header)
                . view('user/signup')
                . view('templates/footer');
        }
        $user = $this->request->getPost(['username', 'email', 'password', 'password1', 'football_team', 'f1_team']);
        //If form is submitted
        //Get Data form the form
        
        //Validate Data
        $isValid = True;

        $model = model(UserModel::class);

        //Check if all fields are compiled
        if($user['username'] == null || $user['email'] == null || $user['password'] == null || $user['f1_team'] == null || $user['football_team'] == null){
            $isValid = False;
        }else if($user['password'] != $user['password1']){
            //check if passwords match
            $isValid = False;
        }
        
        //Check if the userName is present in the database
        if($model->getUser($user['username']) != null){
            $isValid = False;
            
        }

        if($model->checkEmail($user['email']) > 0){
            $isValid = False;
        }

        if($isValid){
            $pass = $this->encryptPassword($user);

            $model->setUser($user, $pass);
            $session->set('user',$user);
            return redirect('/');
        }

        //if data is not valid
        return view('templates/header', $header)
            . view('user/signup')
            . view('templates/footer');
        
    }

    public function logout(){
        $session = session();

        $session->destroy();
        return redirect('/');
    }

    private function encryptPassword($user){
        $salt = substr($user['username'], -2);
        //https://www.w3schools.com/php/func_string_crypt.asp
        $pass = crypt($user['password'], $salt);
        return $pass;
    }
}
