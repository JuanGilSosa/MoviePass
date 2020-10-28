<?php namespace Models\Pelicula;
    
    class Cartelera{

        private $id;
        private $funciones;
        private $fechaDeInicio;
        private $fechaDeFin;

        public function setId($id){
            $this->id = $id;
        }

        public function setFunciones($funciones){
            $this->funciones = $funciones;
        }

        public function getId(){
            return $this->id;
        }

        public function getFunciones(){
            return $this->funciones;
        }


    }
?>