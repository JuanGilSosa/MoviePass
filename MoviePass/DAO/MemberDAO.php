<?php

    namespace DAO;

    use DAO\IDAO;
    use Models\Users\Member as Member;

    class MemberDao implements IDAO
    {
        private $members = array(); 
        
        public function Add($member)
        {
            $this->RetrieveData();

            $member->setId($this->GetNextId());
            array_push($this->members, $member);
            #echo "Aca" . count($this->members);
            $bytes = $this->SaveData();

            return $bytes;
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->members;
        }
        

        public function Delete($idUser){

        }

        public function Update($user){
            
        }

        public function SaveData()
        {
            $arrayToEncode = array();

            $jsonPath = $this->GetJsonFilePath();

            foreach ($this->members as $member)
            {
                $valuesArray["id"] = $member->getId();    
                $valuesArray["dni"] = $member->getDni();    
                $valuesArray["email"] = $member->getEmail();    
                $valuesArray["password"] = $member->getPassword();    
                $valuesArray["firstName"] = $member->getFirstName();
                $valuesArray["lastName"] = $member->getLastName();
                //$valuesArray["idTarjetaDeCredito"] = $member->getIdTarjetaDeCredito();

                array_push($arrayToEncode, $valuesArray);    
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            $bytes = file_put_contents($jsonPath, $jsonContent);
        
            return $bytes;
        
        }

        public function RetrieveData()
        {
            $this->members = array();

            $jsonPath = $this->GetJsonFilePath();

            if (file_exists($jsonPath))
            {
                $jsonContent = file_get_contents($jsonPath);
            
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            
                foreach ($arrayToDecode as $valuesArray)
                {
                    $member = new Member();
                    $member->setID($valuesArray['id']);
                    $member->setDni($valuesArray['dni']);
                    $member->setEmail($valuesArray['email']);
                    $member->setPassword($valuesArray['password']);
                    $member->setFirstName($valuesArray['firstName']);
                    $member->setLastName($valuesArray['lastName']);
                    //$member->setIdTarjetaDeCredito($valuesArray['idTarjetaDeCredito']);
                    array_push($this->members, $member);
                }
        
            }
        
        }

        function GetJsonFilePath(){

            $initialPath = "Data/members.json";
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

            foreach($this->members as $member)
            {
                $id = ($member->getId() > $id) ? $member->getId() : $id;
            }

            return $id + 1;
        }


    }

?>