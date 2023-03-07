<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class F1EventModel extends Model{

        protected $table = 'ci_f1events';
        protected $allowedFields = ['id', 'circuitId', 'season','type', 'laps', 'date', 'status'];

        public function setEvent($event)
        {
            $this->upsert($event);
        }


        public function getEventById($id){
            return $this->where('id', $id)->first();
            
        }

        public function getEventByType($type){
            return $this->where('type', $type)->findAll();
            
        }

        public function getNextEvent(){
            return $this->where('status', 'scheduled')->first();
            
        }

    }
?>