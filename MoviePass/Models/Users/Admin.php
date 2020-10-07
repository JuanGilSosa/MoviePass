<?php

    namespace Models\Users;

    class Admin extends User{

        protected $employeeType;

        public function getEmployeeType(){
            return $this->employeeType;
        }

        public function setEmployeeType($employeeType){
            $this->employeeType = $employeeType;
        }

    }



?>