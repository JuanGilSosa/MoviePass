<?php

    namespace Models\Ubicacion;

    class Provincia
    {
        private $id;
        private $name;
        private $idPais;

        /*public function __construct($id, $name, $idPais)
        {
            $this->id = $id;
            $this->name = $name;
            $this->idPais = $idPais;
        }*/       

        public function getId() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
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

        public function setIdPais($idPais){
            $this->idPais = $idPais;
        }

    }


?>