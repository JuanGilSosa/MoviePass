<?php 
    
    namespace Controllers;
    
    use Helpers\SessionHelper as SessionHelper;

    class LogInController
    {
        private $memberController;
        private $movieController;

        public function __construct(){
            $this->memberController = new MembersController();
            $this->movieController = new MovieController();
        }

        public function LogIn ($email, $password)
        {
            $rta = $this->memberController->VerifyMemberAndPassword($email,$password);
            $this->RedirectLogIn($rta);
        }

        public function LogInFB($obj){
            if(SessionHelper::isSession('user_fb')){
                $rta = $this->memberController->VerifyMemberAndPassword($obj->email,'');
                $this->RedirectLogIn($rta);
            }
            
        }

        public function RedirectLogIn ($message){
            if(SessionHelper::isSession('userLogged')){
                
                HomeController::Index();

            }else{
                ViewsController::ShowLogIn($message);
            }
        }

        public function LogOut(){   
            session_unset();
            session_destroy();
            HomeController::Index();
        }
    }

?>