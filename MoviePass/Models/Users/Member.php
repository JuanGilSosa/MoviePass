<?php

    namespace Models\Users;

    class Member extends User{

        private $numeroTarjetaDeCredito;

        public function __construct ($dni= "", $email= "", $password= "", $firstName= "", $lastName= "",$numeroTarjetaDeCredito = "")
        {
            $this->dni = $dni;
            $this->email= $email;
            $this->password = $password;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->numeroTarjetaDeCredito = $numeroTarjetaDeCredito;
        }

        public function getNumeroTarjetaDeCredito(){
            return $this->numeroTarjetaDeCredito;
        }
        
        public function setNumeroTarjetaDeCredito($numeroTarjetaDeCredito){
            $this->numeroTarjetaDeCredito = $numeroTarjetaDeCredito;
        }

    }



?>