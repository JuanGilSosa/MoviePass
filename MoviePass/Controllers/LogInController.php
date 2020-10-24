<?php namespace Controllers;
    
    class LogInController
    {
        private $memberController;

        public function __construct(){
            $this->memberController = new MembersController();
        }

        public function Logeando ($email, $password)
        {
            $rta = $this->memberController->VerifyMemberAndPassword($email,$password);
            $this->RedirectLogIn($rta);
        }

        public function RedirectLogIn ($message){
            if(SessionController::HayUsuario('userLogged')){
                ViewsController::ShowMoviesListView();
            }else{
                ViewsController::ShowLogIn($message);
            }
        }

        public function LogOut(){
            session_destroy();
            ViewsController::ShowIndex(); 
        }
    }

?>