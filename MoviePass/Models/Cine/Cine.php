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
        private $idCiudad;
        private $idPais;
        
        public function __construct($id = "",$nombre = "", $email = "", $numeroDeContacto = "", $idDireccion="", $idCiudad ="", $idProvincia="", $idPais ="")
        {
            $this->id = $id;
            $this->nombre=$nombre;
            $this->email=$email;
            $this->numeroDeContacto=$numeroDeContacto;
            $this->idDireccion = $idDireccion;
            $this->idCiudad = $idCiudad;
            $this->idProvincia = $idProvincia;
            $this->idPais = $idPais;
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

        public function getIdCiudad(){
            return $this->idCiudad;
        } 
        public function getIdProvincia(){
            return $this->idProvincia;
        }
        public function getIdPais()
        {
            return $this->idPais;
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

        public function setIdCiudad($idCiudad){
            $this->idCiudad = $idCiudad;
        } 
        public function setIdPais($idPais)
        {
            $this->idPais = $idPais;
        }

    }


?>