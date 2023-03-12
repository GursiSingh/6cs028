<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class F1RankingModel extends Model{

        protected $table = 'ci_f1ranking';
        protected $allowedFields = ['race_id', 'driver_id', 'team_id','position', 'time', 'laps', 'pits', 'grid'];

        //Set Ranking of a race
        public function setRanking($rank)
        {
            $this->upsert($rank);
        }

        //Get Ranking of a race
        public function getRaceRanking($raceId){
            return $this->where('race_id', $raceId)->orderBy('position', 'ASC')->findAll();
        }

        public function getTeamPositions($teamId, $raceId){
            $position = $this->select(['position', 'driver_id'])->where('race_id', $raceId)->where('team_id', $teamId)->findAll();
            return $position;
        }

    }
?>