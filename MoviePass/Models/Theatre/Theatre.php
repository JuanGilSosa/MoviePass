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
        private $auditorium;
        private $billboard;
        private $active;

        public function __construct($id = "", $name = "", $email = "", $phoneNumber = "", $adress="")
        {
            
            $this->id = strval($id);
            $this->name = $name;
            $this->email = $email;
            $this->phoneNumber = $phoneNumber;
            $this->adress = $adress;
            $this->auditorium = array();
            $this->billboard = new Billboard();
            $this->active = true;
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

        public function GetAuditorium(){
            return $this->auditorium;
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

        public function setEmail($email){
            $this->email = $email;
        }

        public function SetPhoneNumber($phoneNumber){
            $this->phoneNumber = $phoneNumber;
        }

        public function SetAdress($adress){
            $this->adress = $adress;
        }

        public function SetAuditorium($auditorium){
            $this->auditorium = $auditorium;
        }
        
        public function SetBillboard($billboard){
            $this->billboard = $billboard;
        }
        
        public function setActive($active)
        {
            $this->active = $active;
        }


    }
