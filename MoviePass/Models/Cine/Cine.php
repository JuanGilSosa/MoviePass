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
        private $direcciones;
        private $localidades;

        public function __construct($nombre = "", $email = "", $numeroDeContacto = "")
        {
            $this->nombre=$nombre;
            $this->email=$email;
            $this->numeroDeContacto=$numeroDeContacto;
            $this->direcciones = array();
            $this->localidades = array();
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

        public function getDireccion(){
            return $this->direcciones;
        }

        public function getLocalidad(){
            return $this->localidades;
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

        public function setDireccion(Direccion $direccion){
            array_push($this->direcciones, $direccion);
        }

        public function setLocalidad(Localidad $localidad){
            array_push($this->localidades, $localidad);
        }

    }


?>