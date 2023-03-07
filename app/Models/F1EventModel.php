<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class F1EventModel extends Model{

        protected $table = 'ci_f1events';
        protected $allowedFields = ['id', 'circuitId', 'season','type', 'laps', 'date', 'status'];

        //Set F1 Event From the database
        public function setEvent($event)
        {
            $this->upsert($event);
        }

        //Get F1 Race From the database
        public function getEventById($id){
            return $this->where('id', $id)->first();
            
        }

        //Get F1 Event of requested type From the database
        public function getEventByType($type){
            return $this->where('type', $type)->findAll();
            
        }

        //Get next scheduled F1 Event from the database
        public function getNextEvent(){
            return $this->where('status', 'scheduled')->first();
            
        }

    }
?>