<?php

    namespace Models\Location;

    class City
    {
        private $zipCode;
        private $name;
        private $province;

        public function __construct($zipCode = "", $name = "", $province = "")
        {
            $this->zipCode = (int)$zipCode;
            $this->name = $name; 
            $this->province = $province;
        }        

        public function GetZipCode() {
            return $this->zipCode;
        }

        public function getNameCiudad() {
            return $this->name;
        }

        public function getProvincia() {
            return $this->province;
        }

        public function setCodigoPostal($zipCode)
        {
            $this->zipCode = (int)$zipCode;
        }

        public function setNameCiudad($name){
            $this->name = $name;
        }

        public function setProvincia($province)
        {
            $this->province = $province;
        }

    }


?>