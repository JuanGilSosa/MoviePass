<?php

    namespace Controllers;

    use DAO\AdminDAO as AdminDAO;
    use DAO\MemberDAO as MemberDAO;
    use Models\Users\Member as Member;
    use Models\Users\Admin as Admin;

    class MembersController
    {

        //FIJENSE SI QUIEREN CONTROLAR TODO EN UNO O DIVIDIRLO EN DOS, CREO QUE SERIA MEJOR TENER DOS CONTROLES, AHORA LO DEJO ACA PARA NO OLVIDAR DE HACERLO
        //DE DIVIDIRLO EN DOS VAMOS A TENER QUE PONER LAS FUNCIONES DE LOGIN EN OTRO CONTROLLER, 

        private $adminDAO; 
        private $membersDAO; 

        public function __construct()
        {
            $this->membersDAO = new MemberDAO(); 
            $this->adminDAO = new AdminDAO(); 
        }

        public function ShowIndex()
        {
            require_once(FRONT_ROOT."index.php");            
        }

        public function ShowLogIn($message = "")
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

        public function AddMember($firstName, $lastName, $dni, $email, $password, $checkPassword){

            
            if($password == $checkPassword)
            {
                $member = new Member($dni, $email, $password, $firstName, $lastName);
                 
                $bytes = $this->membersDAO->Add($member);
                
                $this->ShowRegisterForm();
                
                if($bytes == false){
                    echo "error on save";
                } 
            }else{
                $this->ShowLogIn();
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
                $this->ShowLogIn($message);
            }
        }

        public function FindMemberByEmail ($email)
        {
            $loggedMember = null;
            $members = $this->membersDAO->GetAll();

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
                    $rta = "Datos incorrecta";
                }
            }
            else
            {
                $rta = "Datos Incorrecto"; 
            }
                         
            return $rta;
        }

        
        public function LogOut(){
            session_destroy();
            $this->ShowIndex(); 
        }
    }

?>