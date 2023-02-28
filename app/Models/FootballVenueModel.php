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

    }
?>