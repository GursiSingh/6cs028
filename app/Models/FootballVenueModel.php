<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class FootballVenueModel extends Model{
        protected $table = 'ci_venue';
        protected $allowedFields = ['id', 'name', 'address','city', 'capacity', 'image'];

        public function setVenue($venue){

            $data= [
                'id' => $venue->id,
                'name'  => $venue->name,
                'address'  => $venue->address,
                'city'  => $venue->city,
                'capacity'  => $venue->capacity,
                'image'  => $venue->image,
            ];
            return $this->upsert($data);
        }

        public function setTempVenue($venue){

            $data= [
                'id' => $venue['id'],
                'name'  => $venue['name'],
                'address'  => null,
                'city'  => $venue['city'],
                'capacity'  => null,
                'image'  => null,
            ];
            return $this->upsert($data);
        }

        public function getVenue($id){
            return $this->where('id', $id)->findAll();
        }

    }   
?>