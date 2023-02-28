<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

class UserModel extends Model
{
    protected $table = 'ci_user';

    protected $allowedFields = ['username', 'email', 'password','football_team', 'f1_team', 'last_login'];

    public function setUser($user, $pass){

        $data = [
            'username' => $user['username'],
            'email'  => $user['email'],
            'password'  => $pass,
            'football_team'  => $user['football_team'],
            'f1_team'  => $user['f1_team'],
            'last_login'  => new RawSql('CURRENT_TIMESTAMP()'),
        ];

        return $this->save($data);
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