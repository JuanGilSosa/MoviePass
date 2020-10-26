<?php

    namespace Models\Ubicacion;

    class Ciudad
    {
        private $codigoPostal;
        private $nameCiudad;
        private $provincia;

        public function __construct($codigoPostal = "", $nameCiudad = "", $provincia = "")
        {
            $this->codigoPostal = $codigoPostal;
            $this->nameCiudad = $nameCiudad; 
            $this->provincia = $provincia;
        }        

        public function getCodigoPostal() {
            return $this->codigoPostal;
        }

        public function getNameCiudad() {
            return $this->nameCiudad;
        }

        public function getProvincia() {
            return $this->provincia;
        }

        public function setCodigoPostal($codigoPostal)
        {
            $this->codigoPostal = $codigoPostal;
        }

        public function setNameCiudad($nameCiudad){
            $this->nameCiudad = $nameCiudad;
        }

        public function setProvincia($provincia)
        {
            $this->provincia = $provincia;
        }

    }


?>