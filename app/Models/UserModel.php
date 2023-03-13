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

        return $this->upsert($data);
    }
    
    public function getUser($username)
    {
        $this->set('last_login', new RawSql('CURRENT_TIMESTAMP()'))->where('username', $username)->update();
        return $this->where(['username' => $username])->first();
    }

    public function checkEmail($email){
        return $this->where(['email' => $email])->countAllResults();
    }


    public function deleteUser($username){
        return $this->where(['username' => $username])->delete();
    }


    public function editUserFootballTeam($username, $team){
        return $this->set(['football_team' => $team])
                ->where('username', $username)->update();
    }

    public function editUserF1Team($username, $team){
        return $this->set(['f1_team' => $team])
                ->where('username', $username)->update();
    }
    
}

?>