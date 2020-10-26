<?php

    namespace Models\Ubicacion;

    class Pais
    {
        private $id;
        private $namePais;

        public function __construct ($id="", $namePais = ""){
            $this->id = $id;
            $this->namePais = $namePais;
        }        

        public function getId() {
            return $this->id;
        }

        public function getNamePais() {
            return $this->namePais;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setNamePais($namePais){
            $this->namePais = $namePais;
        }
    }
?>