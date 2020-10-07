<?php

    namespace Models\Users;

    class Member extends User{

        private $idTarjetaDeCredito;

        public function getIdTarjetaDeCredito(){
            return $this->idTarjetaDeCredito;
        }
        
        public function setIdTarjetaDeCredito($idTarjeta){
            $this->idTarjetaDeCredito = $idTarjeta;
        }

    }



?>