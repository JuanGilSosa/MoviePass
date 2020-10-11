<?php
    namespace DAO;

    use DAO\IAdminDAO as IAdminDAO;
    use Models\Users\Admin as Admin;
    use Models\Users\Member as Member;
    use Models\Users\User as User;

    class UsersDAO implements IUsersDAO
    {
        private $users = array();
        private $fileName = '../Data/users.json';

        public function AddAdmin(Admin $admin)
        {
            $this->RetrieveData();

            $admin->setId($this->GetNextId());
            
            array_push($this->users, $admin);

            $this->SaveData();
        }

        public function AddMember(Member $member)
        {
            $this->RetrieveData();

            $member->setId($this->GetNextId());
            
            array_push($this->users, $member);

            $this->SaveData();
        }


        public function GetAll()
        {
            $this->RetrieveData();

            return $this->users;
        }

        public function getById($id)
        {
            $this->RetrieveData();

            $administrador = new Admin();

            foreach($this->admins as $admin){
                if ($admin->getId() == $id)
                    $administrador = $admin; 
            }

            return $administrador;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->users as $user)
            {                
                $valuesArray["id"] = $user->getId();
                $valuesArray["dni"] = $user->getDni();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["firstName"] = $user->getFirstName();
                $valuesArray["lastName"] = $user->getLastName();

                if(get_class($user) == "Models\Users\Admin")
                {
                    $valuesArray["employeeType"] = $user->getEmployeeType();                    
                }else{
                    $valuesArray["idTarjetaDeCredito"] = $user->getEmployeeType();
                }

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }


        private function RetrieveData()
        {
                $this->users = array();
                //echo $this->fileName;

                if(file_exists("Data/users.json"))
                {
                $jsonContent = file_get_contents("Data/users.json");
            
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true): array();
        
                    foreach ($arrayToDecode as $value)
                    {
                        $user = new User();
                        $user->setEmail($value["email"]);
                        $user->setPassword($value["password"]);
                        $user->setId($value["id"]);
                        $user->setFirstName($value["firstName"]);
                        $user->setLastName($value["lastName"]);
                        $user->setDni($value["dni"]);
                        array_push ($this->users, $user);
                        //sort($this->userList);
                    }
                }
                else
                    echo "No existe el archivo";

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