<?php

    namespace Models\Ubicacion;

    class Direccion
    {
        private $id;
        private $calle;
        private $numero;
        private $piso;
        private $ciudad;

        public function __construct($id="", $calle = "", $numero = "", $piso = "", $ciudad = "")
        {
            $this->id = $id;
            $this->calle = $calle;
            $this->numero = $numero;
            $this->piso = $piso;
            $this->ciudad = $ciudad;
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

        public function getCiudad()
        {
            return $this->ciudad;
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

        public function setCiudad($ciudad)
        {
            $this->ciudad = $ciudad;
        }


    }


?>