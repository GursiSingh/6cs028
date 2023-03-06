<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class FootballCompetitionModel extends Model{
        protected $table = 'ci_competitions';
        protected $allowedFields = ['id', 'name', 'country','logo', 'flag', 'last_update'];

        public function setCompetition($competition){
            $now = new \DateTime();
            $data = [
                'id' => (int)$competition->id,
                'name'  => $competition->name,
                'country'  => $competition->country,
                'logo'  => $competition->logo,
                'flag'  => $competition->flag,
                'last_update'  => $now->format("d-m-Y H:i:sO"),
            ];

            return $this->upsert($data);
        }

        public function getCompetition($id){
            return $this->where('id', $id)->findAll();
        }

        public function getAllCompetitions(){
            return $this->findAll();
        }

        public function setLastUpdate($competitionId){
            return $this->where('id', $competitionId)->set('last_update', new \DateTime())->update();
        }

        public function getLastUpdate($competitionId){
            return $this->select('last_update')->where('id', $competitionId)->first();
        }
    }
?>