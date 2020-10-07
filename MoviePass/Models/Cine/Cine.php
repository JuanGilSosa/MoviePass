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
        private $direccionId;
        
        public function __construct($nombre = "", $email = "", $numeroDeContacto = "", $direccionId="")
        {
            $this->nombre=$nombre;
            $this->email=$email;
            $this->numeroDeContacto=$numeroDeContacto;
            //$this->direccion = $direccionId;
            //$this->localidad = $localidadId;
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

        /* public function getDireccionId(){
            return $this->direccion;
        }

        public function getLocalidadId(){
            return $this->localidad;
        } */

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

        /* public function setDireccion($direccionId){
            $this->direccionId = $direccionId;
        }

        public function setLocalidad($codigoPostal){
            $this->localidadId = $codigoPostal;
        } */

    }


?>