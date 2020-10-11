<?php

    namespace Models\Users;

    class Admin extends User{

        protected $employeeType;

        public function __construct ($employeeType = ""){
            $this->employeeType = $employeeType;
        }

        public function getEmployeeType(){
            return $this->employeeType;
        }

        public function setEmployeeType($employeeType){
            $this->employeeType = $employeeType;
        }

    }



?>