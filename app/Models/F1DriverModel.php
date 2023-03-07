<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class F1DriverModel extends Model{

        protected $table = 'ci_drivers';
        protected $allowedFields = ['id', 'name', 'abbr','image', 'number', 'points', 'team'];

        public function setDriver($driver)
        {
            $this->upsert($driver);
        }

        public function getTeamDrivers($teamId){
            return $this->where('team', $teamId)->findAll();
        }

        public function getDriver($id){
            return $this->where('id', $id)->first();
            
        }

        public function getStanding(){
            return $this->orderBy('points', 'DESC')->findAll();
        }
    }
?>