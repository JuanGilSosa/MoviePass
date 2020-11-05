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

        public function GetName() {
            return $this->name;
        }

        public function GetProvince() {
            return $this->province;
        }

        public function SetZipCode($zipCode)
        {
            $this->zipCode = (int)$zipCode;
        }

        public function SetName($name){
            $this->name = $name;
        }

        public function SetProvince($province)
        {
            $this->province = $province;
        }

    }


?>