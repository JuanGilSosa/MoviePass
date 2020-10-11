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

        public function LogIn($username, $password)
        {   
            $loggedUser = $this->findMember($username, $password);
            
            if(!is_null($loggedUser)){      
                if ($loggedUser->getEmail() == "false" || $loggedUser->getPassword() == "false" ){
                    require_once(VIEWS_PATH."loginForm.php");   
                }else{
                    $_SESSION["loggedUser"] = $loggedUser;
                    $this->ShowIndex();
                }
            }else{
                require_once(VIEWS_PATH."loginForm.php");   
            }

        }

        public function findMember($email, $password){
            $members = $this->memberDAO->GetAll(); //ESTO //?
            $loggedUser = null; // ESTO //?

            if(count($this->members > 0)){ // ahora si, loggedUser puede volver en null, sin esto verifyUsernameAndPassword() devuelve un objeto de tipo member y si la lista llegara a estar vacia va a tirar error
                foreach($members as $member){
                    $loggedUser = $this->verifyUsernameAndPassword($member, $email, $password);                
                }
            }
            return $loggedUser;
        }

        public function verifyUsernameAndPassword($member, $email, $password){

            if($member->getEmail() == $email){
                if($member->getPassword() == $password)
                    {
                        return $member;
                    }
                    else
                    {
                        $member->setPassword("false");
                        return $member;
                    }
            }else{
                $member->setEmail("false");
                return $member;
            }
        }

        
        public function LogOut(){
            session_destroy();
            $this->ShowIndex(); 
        }
        
    }

?>