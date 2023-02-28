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

    }
?>