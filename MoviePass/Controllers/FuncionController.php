<?php

    namespace Controllers;

    use Database\FuncionesDAO as FuncionesDAO;
    use Database\CarteleraDAO as CarteleraDAO;
    use DAO\PeliculaDAO as PeliculaDAO;
    use Database\CineDAO as CineDAO;
    use Controllers\ViewsController as ViewsController;
    use Database\SalaDAO as SalaDAO;

    class FuncionController{

        private $funcionDAO;
        private $carteleraDAO;
        private $cineDAO;
        private $peliculaDAO;
        private $salaDAO;

        public function __construct(){
            $this->funcionDAO = new FuncionesDAO();
            //$this->carteleraDAO = new CarteleraDAO();
            $this->cineDAO = new CineDAO();
            $this->peliculaDAO = new PeliculaDAO();
            $this->salaDAO = new SalaDAO();
        }

        public function AddFuncion($idCine, $idSala, $idPelicula, $horaInicio, $startCartelera, $endCartelera){
            
        }

        public function ShowAddFuncion($idPelicula){
            $pelicula = $this->peliculaDAO->getMovieById($idPelicula);
            if(!is_null($pelicula)){
                $cines = $this->cineDAO->GetAll();
                $salas = $this->salaDAO->GetAll();
                ViewsController::ShowAddFuncionView($pelicula, $cines, $salas);
            }
        }

    }
?>