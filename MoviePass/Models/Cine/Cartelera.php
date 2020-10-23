<?php namespace Cine;
    
    class Cartelera{

        private $id;


        public function setId($id){
            $this->id = $id;
        }
        public function getId(){
            return $this->id;
        }
    }
?>