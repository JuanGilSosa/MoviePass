<?php

    namespace Models\Cine;

    use Models\Ubicacion\Direccion as Direccion;
    use Models\Ubicacion\Localidad as Localidad;

    class Cine 
    {
        private $id;
        private $nombre;
        private $email;
        private $numeroDeContacto;
        private $idDireccion;
        private $salas;
        private $active;

        public function __construct($nombre = "", $email = "", $numeroDeContacto = "", $idDireccion="")
        {
            $this->salas = array();
            $this->nombre = $nombre;
            $this->email = $email;
            $this->numeroDeContacto = $numeroDeContacto;
            $this->idDireccion = $idDireccion;
            $this->active = true;
        }

        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getNumeroDeContacto(){
            return $this->numeroDeContacto;
        }

        public function getIdDireccion(){
            return $this->idDireccion;
        }

        public function getSalas(){
            return $this->salas;
        }

        public function getActive(){
            return $this->active;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function setNumeroDeContacto($numeroDeContacto){
            $this->numeroDeContacto = $numeroDeContacto;
        }

        public function setIdDireccion($idDireccion){
            $this->idDireccion = $idDireccion;
        }
        public function setSalas($salas){
            $this->salas = $salas;
        }
        public function setActive($active)
        {
            $this->active = $active;
        }


    }


?>