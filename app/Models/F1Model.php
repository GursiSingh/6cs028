<?php

namespace App\Models;

use CodeIgniter\Model;

class F1Model extends Model{

    protected $table = 'ci_f1teams';
    protected $allowedFields = ['id', 'name', 'logo','points', 'world_championships', 'base', 'first_entry', 'president', 'director', 'chassis'];

    public function setTeam($team)
    {
        $this->upsert($team);
    }


    public function getTeams($name){
        return $this->like('name', $name)->findAll();
        
    }


    public function getStanding(){
        return $this->orderBy('points', 'DESC')->findAll();
    }

    public function getTeam($id){
        return $this->where('id', $id)->findAll();
    }
}