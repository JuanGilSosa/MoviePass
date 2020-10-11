<?php

    namespace Models\Ubicacion;

    class Ciudad
    {
        private $ciudad;
        private $codigoPostal;
        private $idProvincia;

        public function __construct($ciudad = "", $codigoPostal = "", $provincia = "", $idPais = "")
        {
            $this->ciudad = $ciudad;
            $this->codigoPostal = $codigoPostal;
            $this->provincia = $provincia;
            $this->idPais = $idPais;
        }        

        public function getId() {
            return $this->id;
        }

        public function getCiudad() {
            return $this->ciudad;
        }

        public function getCodigoPostal() {
            return $this->codigoPostal;
        }

        public function getIdProvincia() {
            return $this->idProvincia;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setCiudad($ciudad){
            $this->ciudad = $ciudad;
        }

        public function setCodigoPostal($codigoPostal)
        {
            $this->codigoPostal = $codigoPostal;
        }

        public function setIdProvincia($idProvincia)
        {
            $this->idProvincia = $idProvincia;
        }

    }


?>