<?php

    namespace Controllers;

    use DAO\UsersDAO as UsersDAO;
    use Models\Users\Member as Member;
    use Models\Users\Admin as Admin;

    class usersController
    {
        private $usersDAO; 

        public function __construct()
        {
            $this->usersDAO = new UsersDAO(); 
        }

        public function ShowIndex()
        {
            require_once(FRONT_ROOT."index.php");            
        }

        public function ShowLogIn()
        {
            require_once(VIEWS_PATH."loginForm.php");            
        }

        public function ShowRegisterForm()
        {
            require_once(VIEWS_PATH."registerForm.php");
        }

        public function ShowListView()
        {
            //require_once(VIEWS_PATH."usersList.php");
        }

        public function AddMember($numeroDocumento, $firstName, $lastName, $email, $password){

            $member = new Member($email, $password, $numeroDocumento, $firstName, $lastName);
            
            $bytes = $this->usersDAO->AddMember($member);
            
            if($bytes == false){
                echo "error on save";
            }

        }

        public function LogIn($username, $password)
        {   
            $loggedUser = $this->findUser($username, $password);
            
            if(!is_null($loggedUser)){
                if ($loggedUser->getEmail() == "false" || $loggedUser->getPassword() == "false" ){
                    require_once(VIEWS_PATH."loginForm.php");   
                }else{
                    $_SESSION["loggedUser"] = $loggedUser;
                    $this->ShowIndex();
                }
            }

        }

        public function findUser($email, $password){
            $users = $this->usersDAO->GetAll(); //ESTO
            $loggedUser = null; // ESTO
            foreach($users as $user){
                $loggedUser = $this->verifyUsernameAndPassword($user, $email, $password);                
            }
            return $loggedUser;
        }

        public function verifyUsernameAndPassword($user, $email, $password){

            if($user->getEmail() == $email){
                if($user->getPassword() == $password)
                    {
                        return $user;
                    }
                    else
                    {
                        $user->setPassword("false");
                        return $user;
                    }
            }else{
                $user->setEmail("false");
                return $user;
            }
        }

        
        public function LogOut(){
            session_destroy();
            $this->ShowIndex(); 
        }
        
    }

?>