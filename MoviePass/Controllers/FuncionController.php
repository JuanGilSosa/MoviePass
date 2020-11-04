<?php

    namespace Controllers;

    use Database\FuncionesDAO as FuncionesDAO;
    use Database\CarteleraDAO as CarteleraDAO;
    use DAO\PeliculaDAO as PeliculaDAO;
    use Database\CineDAO as CineDAO;
    use Database\SalaDAO as SalaDAO;
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

        public function AddFuncion($cineId="", $peliculaId = "", $salaId="",  $horaInicio = "", $fechaInicio = "", $fechaFin="",$message="" ){
            if(!empty($cineId))
            {
                $peliculaId = $cineId;
                $peliculaDAO = new PeliculaDAO();
                $pelicula = $peliculaDAO->getMovieById($peliculaId);
                
                if(!empty($pelicula)){
                    ViewsController::ShowAddFuncion("", $peliculaId, "", "");
                }else{
                    $message = "No encontramos la pelicula seleccionada, intente nuevamente.";
                    ViewsController::ShowAddFuncion($message);
                }
            }else if (!empty($cineId) && !empty($peliculaId)){
                $cineDAO = new CineDAO();
                $cine = $cineDAO->GetCineById($cineId);
                $salaDAO = new SalaDAO();
                $salas = $salaDAO->GetSalasByCineId($cineId);
                $salasArray = $salaDAO->ConvertToArray($salas);
                ViewsController::ShowAddFuncion("", $peliculaId, $cine, $salasArray);
            }
        }
            






    }












?>