<?php

    namespace Models\Location;

    class Province
    {
        private $id;
        private $name;
        private $country;

        public function __construct($id = "", $name = "", $country = "")
        {
            $this->id = (int)$id;
            $this->name = $name;
            $this->country = $country;
        }       

        public function GetId() {
            return $this->id;
        }

        public function GetName() {
            return $this->name;
        }

        public function GetCountry() {
            return $this->country;
        }

        public function SetId($id) {
            $this->id = (int)$id;
        }

        public function SetName ($name){
            $this->name = $name;
        }

        public function SetCountry($country){
            $this->country = $country;
        }

    }


?>