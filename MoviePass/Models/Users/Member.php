<?php

    namespace Models\Users;

    class Member extends User{

        private $idTarjetaDeCredito;

        public function __construct ($dni= "", $email= "", $password= "", $firstName= "", $lastName= "",$idTarjetaDeCredito = "")
        {
            $this->dni = $dni;
            $this->email= $email;
            $this->password = $password;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->idTarjetaDeCredito = $idTarjetaDeCredito;
        }

        public function getIdTarjetaDeCredito(){
            return $this->idTarjetaDeCredito;
        }
        
        public function setIdTarjetaDeCredito($idTarjeta){
            $this->idTarjetaDeCredito = $idTarjeta;
        }

    }



?>