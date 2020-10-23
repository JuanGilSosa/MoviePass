<?php namespace Controllers;
    
    class LogInController
    {

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

        public function free_session(){
            session_destroy();
            ViewsController::ShowLogIn();
        }
    }

?>