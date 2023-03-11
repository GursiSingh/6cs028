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

        public function getAllTeamMatches($teamId){
            
            return $this->where('home', $teamId)->orWhere('away', $teamId)->orderBy('date', 'ASC')->findAll();
        }

        public function getTodaysFixtures(){
            $now = (new \DateTime())->format('Y-m-d');
            $where = "date >= '".$now."T00:00:00' AND date < '".$now."T24:00:00'";
            return $this->where($where)->orderBy('date', 'ASC')->findAll();
        }

        public function getTeamMonthMatches($teamId, $month, $year){
            $date = $year."-".$month;
            $nextMonth = $month + 1;
            
            if($month<=12){
                if($month < 10){

                    $where = "date >= '".$year."-".$month."-01T00:00:00' AND date < '".$year."-0".$nextMonth."-01T00:00:00' AND home='".$teamId."' ";
                    $orWhere = "date >= '".$year."-".$month."-01T00:00:00' AND date < '".$year."-0".$nextMonth."-01T00:00:00' AND away='".$teamId."' ";
                }else{
                    $where = "date >= '".$year."-".$month."-01T00:00:00' AND date < '".$year."-".$nextMonth."-01T00:00:00' AND home='".$teamId."' ";
                    $orWhere = "date >= '".$year."-".$month."-01T00:00:00' AND date < '".$year."-".$nextMonth."-01T00:00:00' AND away='".$teamId."' ";
                }
            }
            else{
                $nextYear = $year + 1;
                $where = "date >= '".$year."-".$month."-01T00:00:00' and date < '".$nextYear."-01-01T00:00:00' AND home='".$teamId."' ";
                $orWhere = "date >= '".$year."-".$month."-01T00:00:00' and date < '".$nextYear."-01-01T00:00:00' AND away='".$teamId."' ";
            }
            return $this->where($where)->orWhere($orWhere)->orderBy('date', 'ASC')->findAll();
        }

        public function getNextMatch( $teamId){
            $where="status != 'FT' AND home=".$teamId." OR status != 'FT' AND away=".$teamId." ";

            return $this->where($where)->orderBy('date','ASC')->first();
        
        }

    }

?>