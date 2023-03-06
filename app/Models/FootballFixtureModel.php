<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class FootballFixtureModel extends Model{

        protected $table = 'ci_fixtures';
        protected $allowedFields = ['id', 'home', 'away', 'date','competitionId', 'goal_away', 'goal_home', 'status', 'venueId', 'winnerId', 'current', 'round'];

        public function setFixture($data){
            return $this->upsert($data);
        }

        public function setCurrentRound($competitionId, $round){

            //set previious round to false
            $previous = [
                'current' => '0',
            ];
            
            $this->where('competitionId',$competitionId)->where('current','1')->set($previous)->update();

            $current = [
                'current' => '1',
            ];
            return $this->where('competitionId',$competitionId)->where('round',$round)->set($current)->update();
        }

        public function getCurrentRound($competitionId){
            return $this->where('competitionId',$competitionId)->where('current', '1')->orderBy('date','ASC')->findAll();
        }

        public function getRound($competitionId, $round){
            return $this->where('competitionId',$competitionId)->where('round', $round)->orderBy('date','ASC')->findAll();
        }

        public function getAllRounds($competitionId){
            return $this->select('round, current')->distinct('round')->where('competitionId',$competitionId)->findAll();
        }

        public function getTeamMatches($teamId){
            
            return $this->where('home', $teamId)->orWhere('away', $teamId)->orderBy('date', 'ASC')->findAll();
        }

        public function getNextMatch( $teamId){
            $where="status != 'FT' AND home=".$teamId." OR status != 'FT' AND away=".$teamId." ";

            return $this->where($where)->orderBy('date','ASC')->first();
        
        }
    }

?>