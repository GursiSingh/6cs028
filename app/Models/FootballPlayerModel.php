<?php

    namespace App\Models;

    use CodeIgniter\Model;
    class FootballPlayerModel extends Model{
        protected $table = 'ci_players';
        protected $allowedFields = ['id', 'name', 'position', 'number','age', 'team', 'image'];

        //Player Name = utf8 https://stackoverflow.com/questions/44212793/how-to-make-nvarchar-column-in-phpmyadmin

        public function setPlayer($player, $teamId){
            $data = [
                'id' => $player->id,
                'name'  => $player->name,
                'position'  => $player->position,
                'number'  => $player->number,
                'age'  => $player->age,
                'team'  => $teamId,
                'image'  => $player->photo,
            ];
            return $this->upsert($data);
        }

        public function getSquad($teamId, $order){
            return $this->where('team', $teamId)->orderBy($order)->findAll();
        }

        function searchPlayersInTeam($teamId, $playerName,$order){
            return $this->where('team', $teamId)->like('name', $playerName)->orderBy($order)->findAll();
        }

        function getSquadByPosition($teamId, $position){
            
            return $this->where('team', $teamId)->where('position', $position)->orderBy('name', 'ASC')->findAll();
        }

    }
?>