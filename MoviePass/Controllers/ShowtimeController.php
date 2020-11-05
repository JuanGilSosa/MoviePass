<?php

    namespace Controllers;

    use Database\ShowtimesDAO as ShowtimesDAO;
    use Database\MoviesDAO as MoviesDAO;
    use Database\TheatreDAO as TheatreDAO;
    use Controllers\ViewsController as ViewsController;
    use Database\CinemaDAO as CinemaDAO;
    use Models\Movie\Showtime as Showtime;

    class ShowtimeController{

        private $showtimeDAO;
        private $theatreDAO;
        private $movieDAO;
        private $cinemaDAO;

        public function __construct(){
            $this->showtimeDAO = new ShowtimesDAO();
            $this->theatreDAO = new TheatreDAO();
            $this->movieDAO = new MoviesDAO();
            $this->cinemaDAO = new CinemaDAO();
        }

        public function AddShowtime($theatreId, $cinemaId, $movieId="", $startTime="", $releaseDate="", $endDate=""){
            if(!empty($theatreId) && !empty($cinemaId) && empty($movieId) && empty($startTime) && empty($startCartelera) && empty($endCartelera)){
                $movieId = $cinemaId;
                $pelicula = $this->movieDAO->GetMovieById($movieId);
                $cine = $this->theatreDAO->GetTheatreById($theatreId);
                $salas=$this->cinemaDAO->GetCinemasByTheatreId($theatreId);
                

                ViewsController::ShowAddFuncionView("", $pelicula->getId(), $cine, $salas);
            }else{
                $pelicula = $this->movieDAO->GetMovieById($movieId);
                $duracion = $this->movieDAO->GetDuracion($movieId);

                $segundosHoraInicio = strtotime($startTime);
                $segundosDuracion = $duracion*60;
                $horaFin=date("H:i",$segundosHoraInicio+$segundosDuracion);


                $cine = $this->theatreDAO->GetTheatreById($theatreId);
                $sala=$this->cinemaDAO->GetSalaById($cinemaId);

                $funcion = new Showtime(0, $pelicula, $startTime, $horaFin, $sala);
                //var_dump($funcion); HASTA ACA OK

                $this->showtimeDAO->Add($funcion);

                
                $lastIdFuncion = $this->showtimeDAO->GetLastId(); #uso esto porque como el objeto tiene 0 - no sirve
                $cinemaId = $sala->getId();

                $this->showtimeDAO->Add_FUNCIONESXSALA($cinemaId, $lastIdFuncion);

                ViewsController::ShowMoviesNowPlaying();

                array_push($cine->getCartelera(), $pelicula);
                var_dump($cine);
            }
        }

        public function ShowAddFuncion($peliculaId){
            $pelicula = $this->movieDAO->GetMovieById($peliculaId);
            if(!is_null($pelicula)){
                $cines = $this->theatreDAO->GetAll();
                $salas = $this->cinemaDAO->GetAll();
                ViewsController::ShowAddFuncionView("", $peliculaId, $cines, $salas);
            }
        }

    }
        
            






    












?>