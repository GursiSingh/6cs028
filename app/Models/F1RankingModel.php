<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class F1RankingModel extends Model{

        protected $table = 'ci_f1ranking';
        protected $allowedFields = ['race_id', 'driver_id', 'team_id','position', 'time', 'laps', 'pits', 'grid'];

        public function setRanking($rank)
        {
            $this->upsert($rank);
        }

        public function getRaceRanking($raceId){
            return $this->where('race_id', $raceId)->orderBy('position', 'DESC')->findAll();
        }

    }
?>