<?php

#cartelera es billboard, funcion es showtime

    namespace Models\Theatre;
    use Models\Movie\Billboard as Billboard;

    use Models\Ubicacion\Direccion as Direccion;
    use Models\Ubicacion\Localidad as Localidad;

    class Theatre 
    {
        /** @var int */
        private $id;
        private $name;
        private $email;
        private $phoneNumber;
        private $adress; 
        /** @var array || null */
        private $cinema;
        private $billboard;
        private $active;

        public function __construct($id = "", $name = "", $email = "", $phoneNumber = "", $adress="", $active = true)
        {
            $this->id = strval($id);
            $this->name = $name;
            $this->email = $email;
            $this->phoneNumber = $phoneNumber;
            $this->adress = $adress;
            $this->cinema = array();
            $this->billboard = new Billboard();
            $this->active = $active;
        }

        public function GetId(){
            return $this->id;
        }

        public function GetName(){
            return $this->name;
        }

        public function GetEmail(){
            return $this->email;
        }

        public function GetPhoneNumber(){
            return $this->phoneNumber;
        }

        public function GetAdress(){
            return $this->adress;
        }

        public function GetCinemas(){
            return $this->cinema;
        }

        public function GetBillboard(){
            return $this->billboard;
        }

        public function GetActive(){
            return $this->active;
        }

        public function SetId($id){
            $this->id = $id;
        }

        public function SetName($name){
            $this->name= $name;
        }

        public function SetEmail($email){
            $this->email = $email;
        }

        public function SetPhoneNumber($phoneNumber){
            $this->phoneNumber = $phoneNumber;
        }

        public function SetAdress($adress){
            $this->adress = $adress;
        }

        public function SetCinemas($cinema){
            $this->cinema = $cinema;
        }
        
        public function SetBillboard($billboard){
            $this->billboard = $billboard;
        }
        
        public function SetActive($active)
        {
            $this->active = $active;
        }


    }
