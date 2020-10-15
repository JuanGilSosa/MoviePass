<?php

    namespace Models\Ubicacion;

    class Direccion
    {
        private $id;
        private $calle;
        private $numero;
        private $piso;
        private $departamento;
        private $codigoPostal;

        public function __construct($calle = "", $numero = "", $piso = "", $departamento = "", $codigoPostal = "")
        {
            $this->calle = $calle;
            $this->numero = $numero;
            $this->piso = $piso;
            $this->departamento = $departamento;
            $this->codigoPostal = $codigoPostal;
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

        public function getCodigoPostal()
        {
            return $this->codigoPostal;
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

        public function setCodigoPostal($codigoPostal)
        {
            $this->codigoPostal = $codigoPostal;
        }


    }


?>