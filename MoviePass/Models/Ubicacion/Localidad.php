<?php

    namespace Ubicacion;

    class Localidad
    {
        private $id;
        private $localidad;
        private $codigoPostal;
        private $provincia;
        private $pais;

        public function __construct($id = "", $localidad = "", $codigoPostal = "", $provincia = "", $pais = "")
        {
            $this->id = $id;
            $this->localidad = $localidad;
            $this->codigoPostal = $codigoPostal;
            $this->provincia = $provincia;
            $this->pais = $pais;
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

        public function getPais() {
            return $this->pais;
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

        public function setPais($pais)
        {
            $this->pais = $pais;
        }
    }


?>