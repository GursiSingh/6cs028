<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class FootballCompetitionModel extends Model{
        protected $table = 'ci_competitions';
        protected $allowedFields = ['id', 'name', 'country','logo', 'flag'];

        public function setCompetition($competition){
        
            $data = [
                'id' => (int)$competition->id,
                'name'  => $competition->name,
                'country'  => $competition->country,
                'logo'  => $competition->logo,
                'flag'  => $competition->flag,
            ];

            return $this->upsert($data);
        }

        public function getCompetition($id){
            return $this->where('id', $id)->findAll();
        }

    }
?>