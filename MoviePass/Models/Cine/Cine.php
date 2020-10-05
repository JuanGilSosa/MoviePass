<?php

    namespace Cine;

    use Ubicacion\Direccion as Direccion;
    use Ubicacion\Localidad as Localidad;

    class Cine 
    {
        private $id;
        private $nombre;
        private $direccion;
        private $localidad;

        public function __construct($nombre = "")
        {
            $this->nombre=$nombre;
            $this->direccion = new Direccion();
            $this->localidad = new Localidad();
        }

        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getDireccion(){
            return $this->direccion;
        }

        public function getLocalidad(){
            return $this->localidad;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setDireccion(Direccion $direccion){
            $this->direccion = $direccion;
        }

        public function setLocalidad(Localidad $localidad){
            $this->localidad = $localidad;
        }

    }


?>