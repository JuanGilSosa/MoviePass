<?php

    namespace Models\Location;

    class Adress
    {
        private $id;
        private $street;
        private $number;
        private $floor;
        private $city;

        public function __construct($id="", $street = "", $number = "", $floor = "", $city = "")
        {
            $this->id = $id;
            $this->street = $street;
            $this->number = (int)$number;
            $this->floor = (int)$floor;
            $this->city = $city;
        }

        public function GetId()
        {
            return $this->id;
        }

        public function GetStreet()
        {
            return $this->street;
        }
        
        public function GetNumber()
        {
            return $this->number;
        }

        public function GetFloor()
        {
            return $this->floor;
        }

        public function GetCity()
        {
            return $this->city;
        }


        public function SetId($id)
        {
            $this->id = $id;
        }

        public function SetStreet($street)
        {
            $this->street = $street;
        }
        
        public function SetNumber($number)
        {
            $this->number = (int)$number;
        }

        public function SetFloor($floor)
        {
            $this->floor = (int)$floor;
        }

        public function SetCity($city)
        {
            $this->city = $city;
        }


    }


?>