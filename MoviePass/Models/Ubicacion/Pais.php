<?php

    namespace Models\Ubicacion;

    class Pais
    {
        private $id;
        private $pais;

        public function __construct($pais = ""){
            $this->pais = $pais;
        }        

        public function getId() {
            return $this->id;
        }

        public function getPais() {
            return $this->pais;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setPais($pais){
            $this->pais = $pais;
        }
    }
?>