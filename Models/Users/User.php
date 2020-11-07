<?php

    namespace Models\Users;

    class User{

        protected $id;
        protected $dni;
        protected $email;
        protected $password;
        protected $firstName;
        protected $lastName;

        public function __construct($dni, $email, $password, $firstName, $lastName){
            $this->dni = $dni;
            $this->email= $email;
            $this->password = $password;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
        }

        public function GetId(){
            return $this->id;
        }

        public function GetDni(){
            return $this->dni;
        }

        public function GetEmail(){
            return $this->email;
        }

        public function GetPassword(){
            return $this->password;
        }

        public function GetFirstName(){
            return $this->firstName;
        }

        public function GetLastName(){
            return $this->lastName;
        }

        public function SetId($id)
        {
            $this->id = $id;
        }

        public function SetDni($dni)
        {
            $this->dni = $dni;
        }

        public function SetEmail($email)
        {
            $this->email = $email; 
        }

        public function SetPassword($password)
        {
            $this->password = $password;
        }

        public function SetFirstName($firstName)
        {
            $this->firstName = $firstName;
        }

        public function SetLastName($lastName)
        {
            $this->lastName = $lastName;
        }
    }



?>