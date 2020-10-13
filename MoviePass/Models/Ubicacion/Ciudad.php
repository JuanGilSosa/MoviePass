<?php

    namespace Models\Ubicacion;

    class Ciudad
    {
        private $id;
        private $name;
        private $codigoPostal;
        private $idProvincia;
        private $idPais;

        public function __construct($id = "", $name = "", $codigoPostal = "", $idProvincia = "", $idPais = "")
        {
            $this->id = $id;
            $this->name = $name;
            $this->codigoPostal = $codigoPostal;
            $this->idProvincia = $idProvincia;
            $this->idPais = $idPais;
        }        

        public function getId() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
        }

        public function getCodigoPostal() {
            return $this->codigoPostal;
        }

        public function getIdProvincia() {
            return $this->idProvincia;
        }

        public function getIdPais() {
            return $this->idPais;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function setCodigoPostal($codigoPostal)
        {
            $this->codigoPostal = $codigoPostal;
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