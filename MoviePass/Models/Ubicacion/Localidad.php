<?php

    namespace Models\Ubicacion;

    class Localidad
    {
        private $localidad;
        private $codigoPostal;
        private $provincia;
        private $idPais;

        public function __construct($localidad = "", $codigoPostal = "", $provincia = "", $idPais="")
        {
            $this->localidad = $localidad;
            $this->codigoPostal = $codigoPostal;
            $this->provincia = $provincia;
            $this->idPais = $idPais;
        }        

        public function getId() {
            return $this->id;
        }

        public function getLocalidad() {
            return $this->localidad;
        }

        public function getCodigoPostal() {
            return $this->codigoPostal;
        }

        public function getProvincia() {
            return $this->provincia;
        }

        public function getIdPais() {
            return $this->idPais;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setLocalidad($localidad){
            $this->localidad = $localidad;
        }

        public function setCodigoPostal($codigoPostal)
        {
            $this->codigoPostal = $codigoPostal;
        }

        public function setProvincia($provincia)
        {
            $this->provincia = $provincia;
        }

        public function setIdPais($idPais)
        {
            $this->idPais = $idPais;
        }
    }


?>