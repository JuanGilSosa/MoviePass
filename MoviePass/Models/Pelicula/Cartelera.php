<?php namespace Models\Pelicula;
    
    class Cartelera{

        private $id;
        private $funciones;
        private $fechaDeInicio;
        private $fechaDeFin;

        public function __construct($id ="", $funciones ="", $fechaDeInicio = "", $fechaDeFin = ""){
            $this->id = $id;
            $this->funciones = array();
            $this->fechaDeInicio = $fechaDeInicio;
            $this->fechaDeFin = $fechaDeFin;
        }

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