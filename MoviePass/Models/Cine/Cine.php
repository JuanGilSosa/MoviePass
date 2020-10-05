<?php

    namespace Cine;

    use Ubicacion\Direccion as Direccion;
    use Ubicacion\Localidad as Localidad;

    class Cine 
    {
        private $id;
        private $nombre;
        private $direcciones;
        private $localidades;

        public function __construct($nombre = "")
        {
            $this->nombre=$nombre;
            $this->direcciones = array();
            $this->localidades = array();
        }

        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
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

        public function setDireccion(Direccion $direccion){
            array_push($this->direcciones, $direccion);
        }

        public function setLocalidad(Localidad $localidad){
            array_push($this->localidades, $localidad);
        }

    }


?>