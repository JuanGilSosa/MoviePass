<?php

    namespace Models\Users;

    use Models\Shopping\Cart as Cart;

    class Member extends User{

        private $creditCardNumber;
        private $cart;

        public function __construct ($dni= "", $email= "", $password= "", $firstName= "", $lastName= "",$creditCardNumber = "")
        {
            //parent::__construct($dni, $email, $password, $firstName, $lastName);
            $this->dni = $dni;
            $this->email= $email;
            $this->password = $password;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->creditCardNumber = $creditCardNumber;
            $this->cart = new Cart();
        }

        public function GetCreditCardNumber(){
            return $this->creditCardNumber;
        }
        
        public function SetCreditCardNumber($creditCardNumber){
            $this->creditCardNumber = $creditCardNumber;
        }

        public function GetCart(){return $this->cart;}

    }



?>