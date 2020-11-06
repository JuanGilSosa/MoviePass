<?php namespace Controllers;
    
    use Helpers\SessionHelper as SessionHelper;

    class LogInController
    {
        private $memberController;
        private $peliculaController;

        public function __construct(){
            $this->memberController = new MembersController();
            $this->peliculaController = new PeliculaController();
        }

        public function LogIn ($email, $password)
        {
            $rta = $this->memberController->VerifyMemberAndPassword($email,$password);
            $this->RedirectLogIn($rta);
        }

        public function LogInFB($obj){
            if(SessionHelper::HayUsuario('user_fb')){
                $rta = $this->memberController->VerifyMemberAndPassword($obj->email,'');
                $this->RedirectLogIn($rta);
            }
            
        }

        public function RedirectLogIn ($message){
            if(SessionHelper::HayUsuario('userLogged')){
                
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