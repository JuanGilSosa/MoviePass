<?php

    namespace DAO;

    use DAO\IDAO;
    use Models\Users\Admin as Admin;

    class AdminDAO implements IDAO
    {
        private $admins = array(); 

        public function Add($admin)
        {
            $this->RetrieveData();

            $admin->setId($this->GetNextId());
            array_push($this->admins, $admin);
            $bytes = $this->SaveData();

            return $bytes;
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->admins;
        }

        
        public function Delete($idAdmin){

        }

        public function Update($admin){
            
        }

        public function SaveData()
        {
            $arrayToEncode = array();

            $jsonPath = $this->GetJsonFilePath();

            foreach ($this->admins as $admin)
            {
                $valuesArray["id"] = $admin->getId();  
                $valuesArray["dni"] = $admin->getDni();    
                $valuesArray["email"] = $admin->getEmail();    
                $valuesArray["password"] = $admin->getPassword();        
                $valuesArray["firstName"] = $admin->getFirstName();
                $valuesArray["lastName"] = $admin->getLastName();
                $valuesArray["employeeType"] = $admin->getEmployeeType();
                
                array_push($arrayToEncode, $valuesArray);    
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            $bytes = file_put_contents($jsonPath, $jsonContent);
        
            return $bytes;
        
        }

        public function RetrieveData()
        {
            $this->users = array();

            $jsonPath = $this->GetJsonFilePath();

            if (file_exists($jsonPath))
            {
                $jsonContent = file_get_contents($jsonPath);
            
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            
                foreach ($arrayToDecode as $valuesArray)
                {
                    $admin = new Admin();
                    $admin->setId($valuesArray['id']);
                    $admin->setDni($valuesArray['dni']);
                    $admin->setEmail($valuesArray['email']);
                    $admin->setPassword($valuesArray['password']);
                    $admin->setFirstName($valuesArray['firstName']);
                    $admin->setLastName($valuesArray['lastName']);
                    $admin->setEmployeeType($valuesArray['employeeType']);
                    
                    array_push($this->admins, $admin);
                }
                
            }
        
        }

        function GetJsonFilePath(){

            $initialPath = "Data/Admins.json";
            if(file_exists($initialPath)){
                $jsonFilePath = $initialPath;
            }else{
                $jsonFilePath = "../".$initialPath;
            }

            return $jsonFilePath;
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->admins as $admin)
            {
                $id = ($admin->getId() > $id) ? $admin->getId() : $id;
            }

            return $id + 1;
        }


    }

?>