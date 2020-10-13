<?php

    namespace Models\Ubicacion;

    class Provincia
    {
        private $id;
        private $nameProvincia;
        private $idPais;

        public function __construct($id = "", $nameProvincia = "", $idPais = "")
        {
            $this->id = $id;
            $this->nameProvincia = $nameProvincia;
            $this->idPais = $idPais;
        }       

        public function getId() {
            return $this->id;
        }

        public function getNameProvincia() {
            return $this->nameProvincia;
        }

        public function getIdPais() {
            return $this->idPais;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setNameProvincia ($nameProvincia){
            $this->nameProvincia = $nameProvincia;
        }

        public function setIdPais($idPais){
            $this->idPais = $idPais;
        }

    }


?>