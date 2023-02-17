<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'ci_user';

    protected $allowedFields = ['username', 'email', 'password','football_team', 'f1_team', 'last_login'];

    public function setUser($user){
        
    }
    
    public function getUser($username)
    {
        
        return $this->where(['username' => $username])->first();
    }

    public function checkEmail($email){
        return $this->where(['email' => $email])->countAllResults();
    }


    public function deleteUser($username){
        return $this->where(['username' => $username])->delete();
    }


    public function editUser($username, $user){
        return $this->set($user)
                ->where(['username' => $username])->update();
    }
    
}