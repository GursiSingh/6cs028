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
        public function getAllEventByType($type){
            return $this->where('type', $type)->findAll();
            
        }

        //Get next scheduled F1 Event circuit id from the database
        public function getNextEventCircuitid(){
            return $this->select('circuitId')->where('status', 'Scheduled')->first();
            
        }

        //Get next scheduled F1 Event by circuit id from the database
        public function getEventsByCircuit($circuitId){
            return $this->where('circuitId', $circuitId)->orderBy('date', 'ASC')->findAll();
            
        }

        //get all f1 events of type race
        public function getAllRaces(){
            return $this->where('type', 'Race')->orderBy('date', 'ASC')->findAll();
        } 

        //get all events in a month 
        public function getMonthRaces($month, $year){
            $date = $year."-".$month;
            $nextMonth = $month + 1;
            
            if($month<=12){
                if($month < 10){

                    $where = "date >= '".$year."-".$month."-01T00:00:00' AND date < '".$year."-0".$nextMonth."-01T00:00:00'";
                }else{
                    $where = "date >= '".$year."-".$month."-01T00:00:00' AND date < '".$year."-".$nextMonth."-01T00:00:00'";
                }
            }
            else{
                $nextYear = $year + 1;
                $where = "date >= '".$year."-".$month."-01T00:00:00' and date < '".$nextYear."-01-01T00:00:00'";
            }
            return $this->where($where)->orderBy('date', 'ASC')->findAll();
        }

        //Get completed Races
        public function getCompletedRaces(){
            return $this->where('type', 'Race')->where('status', 'Completed')->orderBy('date', 'ASC')->findAll();
        }

        //Get completed Races
        public function getLastRace(){
            return $this->where('type', 'Race')->where('status', 'Completed')->orderBy('date', 'DESC')->first();
        }
    }
?>