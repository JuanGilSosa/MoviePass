<?php namespace DAO;

    class SalaDAO implements IDAO{

        private $salas;

        public function __construct(){
            $this->salas = array();
        }

        public function Add($obj){
            
        }

        public function GetAll(){
            $this->RetrieveSalas();
            return $this->salas;
        }
        public function Update($obj){

        }
        public function Delete($obj){

        }
        
        public function GetNextId(){

            $id = 0;

            foreach($this->salas as $sala)
            {
                $id = ($sala->getId() > $id) ? $sala->getId() : $id;
            }

            return $id + 1;
        }
    }

?>