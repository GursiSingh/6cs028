<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class FootballTeamModel extends Model{
        protected $table = 'ci_teams';
        protected $allowedFields = ['id', 'name', 'code', 'founded','logo', 'league_competition', 'points'];

        public function setTeam($team, $points, $venue, $competitionId){
        
            $data = [
                'id' => $team->id,
                'name'  => $team->name,
                'code'  => $team->code,
                'league_competition'  => $competitionId,
                'logo'  => $team->logo,
                'founded'  => $team->founded,
                'points'  => $points,
                'venue'  => $venue->id,
            ];
            return $this->upsert($data);
        }

        public function setTempTeam($team, $venueId){

            if($venueId != null){
                $data = [
                    'id' => $team->id,
                    'name'  => $team->name,
                    'code'  => null,
                    'league_competition'  => null,
                    'logo'  => $team->logo,
                    'founded'  => null,
                    'points'  => null,
                    'venue'  => $venueId,
                ];
            }else{
                $data = [
                    'id' => $team->id,
                    'name'  => $team->name,
                    'code'  => null,
                    'league_competition'  => null,
                    'logo'  => $team->logo,
                    'founded'  => null,
                    'points'  => null,
                    'venue'  => null,
                ];
            }
            
            return $this->upsert($data);
        }

        public function getTeams($name){
            return $this->like('name', $name)->findAll();
        }

        public function getTeam($id){
            return $this->where('id', $id)->findAll();
        }

        public function getStanding($competitionId){
            return $this->like('league_competition', $competitionId)->orderBy('points', 'DESC')->findAll();
        }

        public function getTeamPosition($competitionId, $teamId){
            $standing = $this->getStanding($competitionId);
            
            for($i = 0; $i < sizeof($standing); $i++){
                if($standing[$i]['id'] === $teamId){
                    return $i+1;
                }
            }
        }

        public function updateTeamPoints($competitionId, $teamId, $points){
            return $this->where('id', $teamId)->where('league_competition', $competitionId)->set('points', $points)->update();
        }


    }
?>