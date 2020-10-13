<?php

    namespace Models\Ubicacion;

    class Ciudad
    {
        private $codigoPostal;
        private $nameCiudad;
        private $idProvincia;
        private $idPais;

        public function __construct($codigoPostal = "", $nameCiudad = "", $idProvincia = "", $idPais = "")
        {
            $this->codigoPostal = $codigoPostal;
            $this->nameCiudad = $nameCiudad; 
            $this->idProvincia = $idProvincia;
            $this->idPais = $idPais;
        }        

        public function getCodigoPostal() {
            return $this->codigoPostal;
        }

        public function getNameCiudad() {
            return $this->nameCiudad;
        }

        public function getIdProvincia() {
            return $this->idProvincia;
        }

        public function getIdPais() {
            return $this->idPais;
        }

        public function setCodigoPostal($codigoPostal)
        {
            $this->codigoPostal = $codigoPostal;
        }

        public function setNameCiudad($nameCiudad){
            $this->nameCiudad = $nameCiudad;
        }

        public function setIdProvincia($idProvincia)
        {
            $this->idProvincia = $idProvincia;
        }

        public function setIdPais($idPais) {
            $this->idPais = $idPais;
        }

    }


?>