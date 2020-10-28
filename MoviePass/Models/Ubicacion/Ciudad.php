<?php

    namespace Models\Ubicacion;

    class Ciudad
    {
        private $codigoPostal;
        private $nameCiudad;
        private $pais;
        #private $provincia;

        public function __construct($codigoPostal = "", $nameCiudad = "", $pais = "")
        {
            $this->codigoPostal = $codigoPostal;
            $this->nameCiudad = $nameCiudad; 
            $this->pais = $pais;
        }        

        public function getCodigoPostal() {
            return $this->codigoPostal;
        }

        public function getNameCiudad() {
            return $this->nameCiudad;
        }

        public function getPais() {
            return $this->pais;
        }

        public function setCodigoPostal($codigoPostal)
        {
            $this->codigoPostal = $codigoPostal;
        }

        public function setNameCiudad($nameCiudad){
            $this->nameCiudad = $nameCiudad;
        }

        public function setProvincia($pais)
        {
            $this->pais = $pais;
        }

    }


?>