<?php

    namespace Controllers;

    use DAO\UsersDAO as UsersDAO;
    use Models\Users\Member as Member;
    use Models\Users\Admin as Admin;
    use Models\Users\User as User;

    class usersController
    {
        private $usersDAO; 

        public function __construct()
        {
            $this->usersDAO = new UsersDAO(); 
        }

        public function ShowIndex($message="")
        {
            require_once(FRONT_ROOT."index.php");            
        }

        public function ShowLogIn($message="")
        {
            require_once(VIEWS_PATH."loginForm.php");            
        }

        public function ShowRegisterForm()
        {
            require_once(VIEWS_PATH."registerForm.php");
        }

        public function ShowAddCineView($message="")
        {
            require_once(VIEWS_PATH."addCine.php");
        }

        public function AddMember($numeroDocumento, $firstName, $lastName, $email, $password){

            $member = new Member($email, $password, $numeroDocumento, $firstName, $lastName);
            
            $bytes = $this->usersDAO->AddMember($member);
            
            if($bytes == false){
                echo "error on save";
            }

        }

        public function login ($email, $password)
        {
            $rta = 0;
            
            $users = $this->usersDAO->GetAll();

            foreach ($users as $user)
            {
                $rta = $this->verificarUsuarioYPassword($user,$email,$password);
                
            }
            $message = "Logeo ok.";
            $this->direccionarLogin($message);
        }

        public function direccionarLogin ($message)
        {
            if(isset($_SESSION["loggedUser"]))
            {
                $this->ShowAddCineView($message);
            }
            else
            {
                $message = "Sin usuario";
                $this->ShowLogIn($message);
            }
        }



        public function verificarUsuarioYPassword($user, $email, $password)
        {
            $rta = 0;

            if ($user->getEmail() == $email)
            {
                if($user->getPassword() == $password)
                {
                    $_SESSION["loggedUser"] = $user;
                    $rta = 1;
                }
                else
                {
                    $rta = 2;
                }
            }
            else
            {
                $rta = 3;
            }
    
            return $rta;
        }

        
        public function LogOut($message="") {
            
            unset($_SESSION["loggedUser"]);
            session_destroy();
            $this->ShowLogIn($message);
        }
        
        public function hayUsuario () {

            if(!isset($_SESSION["loggedUser"]))
            {
                $this->ShowLogIn;
            }
        }
    }

?>