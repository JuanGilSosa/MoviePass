<?php

    namespace Models\Users;

    class Admin extends User{

        protected $employeeType;

        public function __construct ($employeeType = ""){
            //parent::__construct($dni, $email, $password, $firstName, $lastName);
            $this->employeeType = $employeeType;
        }

        public function GetEmployeeType(){
            return $this->employeeType;
        }

        public function SetEmployeeType($employeeType){
            $this->employeeType = $employeeType;
        }

    }



?>