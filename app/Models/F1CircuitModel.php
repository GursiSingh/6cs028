<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class F1CircuitModel extends Model{

        protected $table = 'ci_circuits';
        protected $allowedFields = ['id', 'name', 'country','image', 'distance'];

        public function setCircuit($circuit)
        {
            $this->upsert($circuit);
        }

        public function getCircuit($id){
            return $this->where('id', $id)->first();
        }

    }
?>