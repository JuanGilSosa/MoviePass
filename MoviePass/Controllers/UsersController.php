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
            $rta = "";
            $rta = $this->verificarUsuarioYPassword($email,$password);
            $this->direccionarLogin($rta);

        }

        public function direccionarLogin ($message)
        {
            if(isset($_SESSION["loggedUser"]))
            {
                $this->ShowAddCineView($message);
            }
            else
            {
                //$message = "Sin usuario";
                $this->ShowLogIn($message);
            }
        }

        public function buscarUsuario ($email)
        {
            $userEncontrado;
            $users = $this->usersDAO->GetAll();

            foreach ($users as $user)
            {
                if($user->getEmail() == $email)
                {
                    $userEncontrado = $user;
                }
            }
            return $userEncontrado;
        }

        public function verificarUsuarioYPassword($email, $password)
        {
            $rta = "";
            $userEncontrado = $this->buscarUsuario($email);

            if (isset($userEncontrado))
            {
                if ($userEncontrado->getPassword() == $password)
                {
                    $_SESSION["loggedUser"] = $userEncontrado;
                }
                else
                {
                    $rta = "Contraseña incorrecta";
                }
            }
            else{
                $rta = "Email Incorrecto"; 
            }
                         
            return $rta;
        }
        
        public function LogOut($message="") {
            
            unset($_SESSION["loggedUser"]);
            session_destroy();
            $this->ShowLogIn($message);
        }
        
    }

?>