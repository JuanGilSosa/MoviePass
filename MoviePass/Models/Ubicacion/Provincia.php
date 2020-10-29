<?php

    namespace Models\Ubicacion;

    class Provincia
    {
        private $id;
        private $nameProvincia;
        private $pais;

        public function __construct($id = "", $nameProvincia = "", $pais = "")
        {
            $this->id = (int)$id;
            $this->nameProvincia = $nameProvincia;
            $this->pais = $pais;
        }       

        public function getId() {
            return $this->id;
        }

        public function getNameProvincia() {
            return $this->nameProvincia;
        }

        public function getPais() {
            return $this->pais;
        }

        public function setId($id) {
            $this->id = (int)$id;
        }

        public function setNameProvincia ($nameProvincia){
            $this->nameProvincia = $nameProvincia;
        }

        public function setPais($pais){
            $this->pais = $pais;
        }

    }


?>