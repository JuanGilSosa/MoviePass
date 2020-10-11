<?php

    namespace Controllers;

    use DAO\AdminDAO as AdminDAO;
    use DAO\MemberDAO as MemberDAO;
    use Models\Users\Member as Member;
    use Models\Users\Admin as Admin;

    class MembersController
    {
        private $adminDAO; //FIJENSE SI QUIEREN CONTROLAR TODO EN UNO O DIVIDIRLO EN DOS, CREO QUE SERIA MEJOR TENER DOS CONTROLES, AHORA LO DEJO ACA PARA NO OLVIDAR DE HACERLO
        private $membersDAO; 

        public function __construct()
        {
            $this->memberDAO = new MemberDAO(); 
            $this->adminDAO = new AdminDAO(); 
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

        public function ShowAddCineView()
        {
            require_once(VIEWS_PATH."addCine.php");
        }

        public function ShowListView()
        {
            //require_once(VIEWS_PATH."usersList.php");
        }

        public function AddMember($numeroDocumento, $firstName, $lastName, $email, $password){

            $member = new Member($email, $password, $numeroDocumento, $firstName, $lastName);
            
            $bytes = $this->memberDAO->AddMember($member);
            
            if($bytes == false){
                echo "error on save";
            }

        }

        public function LogIn ($email, $password)
        {
            $rta = $this->VerifyMemberAndPassword($email,$password);
            $this->RedirectLogIn($rta);

        }

        public function RedirectLogIn ($message)
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

        public function FindMemberByEmail ($email)
        {
            $loggedMember = null;
            $members = $this->memberDAO->GetAll();

            foreach ($members as $member)
            {
                if($member->getEmail() == $email)
                {
                    return $member;
                }
            }
            return $loggedMember;
        }

        public function VerifyMemberAndPassword($email, $password)
        {
            $rta = "";
            $loggedMember = $this->FindMemberByEmail($email);

            if ($loggedMember != null) 
            {
                if ($loggedMember->getPassword() == $password)
                {
                    $_SESSION["loggedUser"] = $loggedMember;
                }
                else
                {
                    $rta = "Contraseña incorrecta";
                }
            }
            else
            {
                $rta = "Email Incorrecto"; 
            }
                         
            return $rta;
        }

        
        public function LogOut(){
            session_destroy();
            $this->ShowIndex(); 
        }
        
    }

?>