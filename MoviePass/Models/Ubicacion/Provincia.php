<?php

    namespace Models\Ubicacion;

    class Provincia
    {
        private $id;
        private $provincia;
        private $idPais;

        public function __construct($pais = "")
        {
            $this->pais = $pais;
        }        

        public function getId() {
            return $this->id;
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

        public function setProvincia($provincia){
            $this->provincia = $provincia;
        }

        public function setPais($idPais){
            $this->idPais = $idPais;
        }

    }


?>