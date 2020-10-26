<?php namespace Controllers;
    
    class LogInController
    {
        private $memberController;
        private $peliculaController;

        public function __construct(){
            $this->memberController = new MembersController();
            $this->peliculaController = new PeliculaController();
        }

        public function Logeando ($email, $password)
        {
            $rta = $this->memberController->VerifyMemberAndPassword($email,$password);
            $this->RedirectLogIn($rta);
        }

        public function RedirectLogIn ($message){
            if(SessionController::HayUsuario('userLogged')){
                ViewsController::ShowMoviesListView(0
                    /*$this->peliculaController->getPeliculaDAO()->GetAll(),
                    $this->peliculaController->getGeneroDAO()->GetAll()*/
                );
            }else{
                ViewsController::ShowLogIn($message);
            }
        }

        public function LogOut(){
            session_destroy();
            ViewsController::ShowLogIn(); 
        }
    }

?>