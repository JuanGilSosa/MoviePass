<?php

    namespace Controllers;

    use Database\FuncionesDAO as FuncionesDAO;
    use Database\CarteleraDAO as CarteleraDAO;
    use DAO\PeliculaDAO as PeliculaDAO;
    use Database\CineDAO as CineDAO;
    use Controllers\ViewsController as ViewsController;
    use Database\SalaDAO as SalaDAO;
    use Models\Pelicula\Funcion as Funcion;

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

        public function AddFuncion($idCine, $idSala, $idPelicula="", $horaInicio="", $startCartelera="", $endCartelera=""){
            if(!empty($idCine) && !empty($idSala) && empty($idPelicula) && empty($horaInicio) && empty($startCartelera) && empty($endCartelera)){
                $idPelicula = $idSala;
                $pelicula = $this->peliculaDAO->getMovieById($idPelicula);
                $cine = $this->cineDAO->GetCineById($idCine);
                $salas=$this->salaDAO->GetSalasByCineId($idCine);
                

                ViewsController::ShowAddFuncionView("", $pelicula->getId(), $cine, $salas);
            }else{
                $pelicula = $this->peliculaDAO->getMovieById($idPelicula);
                $duracion = $this->peliculaDAO->GetDuracion($idPelicula);

                $segundosHoraInicio = strtotime($horaInicio);
                $segundosDuracion = $duracion*60;
                $horaFin=date("H:i",$segundosHoraInicio+$segundosDuracion);


                $cine = $this->cineDAO->GetCineById($idCine);
                $sala=$this->salaDAO->GetSalaById($idSala);

                $funcion = new Funcion(0, $pelicula, $horaInicio, $horaFin, $sala);
                //var_dump($funcion); HASTA ACA OK

                $this->funcionDAO->Add($funcion);

                
                $lastIdFuncion = $this->funcionDAO->GetLastId(); #uso esto porque como el objeto tiene 0 - no sirve
                $idSala = $sala->getId();

                $this->funcionDAO->Add_FUNCIONESXSALA($idSala, $lastIdFuncion);

                ViewsController::ShowMoviesNowPlaying();

                array_push($cine->getCartelera(), $pelicula);
                var_dump($cine);
            }
        }

        public function ShowAddFuncion($peliculaId){
            $pelicula = $this->peliculaDAO->getMovieById($peliculaId);
            if(!is_null($pelicula)){
                $cines = $this->cineDAO->GetAll();
                $salas = $this->salaDAO->GetAll();
                ViewsController::ShowAddFuncionView("", $peliculaId, $cines, $salas);
            }
        }

    }
        
            






    












?>