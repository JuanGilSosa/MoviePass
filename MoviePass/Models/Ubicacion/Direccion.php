<?php

    namespace Models\Ubicacion;

    class Direccion
    {
        private $id;
        private $calle;
        private $numero;
        private $piso;
        private $departamento;
        private $idLocalidad;

        public function __construct( $calle = "", $numero = "", $piso = "", $departamento = "", $idLocalidad = "")
        {
            $this->calle = $calle;
            $this->numero = $numero;
            $this->piso = $piso;
            $this->departamento = $departamento;
            $this->idLocalidad = $idLocalidad;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getCalle()
        {
            return $this->calle;
        }
        
        public function getNumero()
        {
            return $this->numero;
        }

        public function getPiso()
        {
            return $this->piso;
        }

        public function getDepartamento()
        {
            return $this->departamento;
        }

        public function getIdPais()
        {
            return $this->idLocalidad;
        }


        public function setId($id)
        {
            $this->id = $id;
        }

        public function setCalle($calle)
        {
            $this->calle = $calle;
        }
        
        public function setNumero($numero)
        {
            $this->numero = $numero;
        }

        public function setPiso($piso)
        {
            $this->piso = $piso;
        }

        public function setDepartamento($departamento)
        {
            $this->departamento = $departamento;
        }

        public function setIdPais($idLocalidad)
        {
            $this->idLocalidad = $idLocalidad;
        }


    }


?>