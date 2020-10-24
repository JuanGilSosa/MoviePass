<?php namespace Controllers;
    
    use DAO\MemberDAO as MemberDAO;
    use Models\Users\Member as Member;

    class LogInController
    {

        private $memberDAO;

        public function __construct ()
        {
            $this->memberDAO = new MemberDAO();

        }

        public function LogIn ($email, $password)
        {
            $rta = $this->VerifyMemberAndPassword($email,$password);
            $this->RedirectLogIn($rta);
        }

        public function RedirectLogIn ($message)
        {
            if(isset($_SESSION["userLogged"])){
                ViewsController::ShowMoviesListView();
            }
            else{
                ViewsController::ShowLogIn();

            }
        }

        public function VerifyMemberAndPassword($email, $password)
        {
            $rta = "";
            $loggedMember = $this->FindMemberByEmail($email);

            if ($loggedMember != null) 
            {
                if ($loggedMember->getPassword() == $password)
                {
                    $_SESSION["userLogged"] = $loggedMember;
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

        public function free_session(){
            session_destroy();
            ViewsController::ShowLogIn();
        }
    }

?>