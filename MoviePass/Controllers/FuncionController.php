<?php

    namespace Controllers;

    use Database\FuncionesDAO as FuncionesDAO;
    use Database\CarteleraDAO as CarteleraDAO;
    use DAO\PeliculaDAO as PeliculaDAO;
    use Database\CineDAO as CineDAO;
    use Controllers\ViewsController as ViewsController;


    class FuncionController{

        private $funcionDAO;
        private $carteleraDAO;
        private $cineDAO;

        public function __construct(){
            $this->funcionDAO = new FuncionesDAO();
            //$this->carteleraDAO = new CarteleraDAO();
            $this->cineDAO = new CineDAO();
        }

        public function AddFuncion($peliculaId = "",$message="", $cineId="", $salaId="", $horario = ""){
                
            if(!empty($peliculaId) && empty($horario) && empty($cineId) && empty($salaId))
            {
                $peliculaDAO = new PeliculaDAO();
                $pelicula = $peliculaDAO->getMovieById($peliculaId);
                
                if(!empty($pelicula)){
                    ViewsController::ShowAddFuncion("", $peliculaId);
                }else{
                    $message = "No encontramos la pelicula seleccionada, intente nuevamente.";
                    ViewsController::ShowAddFuncion($message);
                }
            } else {
                var_dump($peliculaId);
            }
        }
            






    }












?>