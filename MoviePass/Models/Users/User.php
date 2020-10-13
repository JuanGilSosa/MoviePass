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

        public function getId(){
            return $this->id;
        }

        public function getDni() {
            return $this->dni;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getPassword() {
            return $this->password;
        }

        public function getFirstName() {
            return $this->firstName;
        }

        public function getLastName() {
            return $this->lastName;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function setDni($dni)
        {
            $this->dni = $dni;
        }

        public function setEmail($email)
        {
            $this->email = $email; 
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function setFirstName($firstName)
        {
            $this->firstName = $firstName;
        }

        public function setLastName($lastName)
        {
            $this->lastName = $lastName;
        }
    }



?>