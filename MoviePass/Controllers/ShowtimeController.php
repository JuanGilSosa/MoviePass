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
                $movie = $this->movieDAO->GetMovieById($movieId);
                $theatre = $this->theatreDAO->GetTheatreById($theatreId);
                $cinemas=$this->cinemaDAO->GetCinemasByTheatreId($theatreId);
                

                ViewsController::ShowAddFuncionView("", $movie->getId(), $theatre, $cinemas);
            }else{
                $movie = $this->movieDAO->GetMovieById($movieId);
                $runtime = $this->movieDAO->GetRuntime($movieId);

                $startTimeSeconds = strtotime($startTime);
                $runtimeSeconds = $runtime*60;
                $endTime=date("H:i", $startTimeSeconds+$runtimeSeconds);


                $theatre = $this->theatreDAO->GetTheatreById($theatreId);
                $cinema=$this->cinemaDAO->GetCinemaById($cinemaId);

                $showtime = new Showtime(0, $movie, $startTime, $endTime, $cinema);
                //var_dump($showtime); HASTA ACA OK

                $this->showtimeDAO->Add($showtime);

                
                $showtimeLastId = $this->showtimeDAO->GetLastId(); #uso esto porque como el objeto tiene 0 - no sirve
                $cinemaId = $cinema->GetId();

                $this->showtimeDAO->Add_showtimesXcinemas($cinemaId, $showtimeLastId);

                ViewsController::ShowMoviesNowPlaying();
/*
                array_push($theatre->GetCartelera(), $movie);
                var_dump($theatre);*/
            }
        }

        public function ShowAddShowtime($movieId){
            $movie = $this->movieDAO->GetMovieById($movieId);
            if(!is_null($movie)){
                $cines = $this->theatreDAO->GetAll();
                $cinemas = $this->cinemaDAO->GetAll();
                
                ViewsController::ShowAddFuncionView("", $movieId, $cines, $cinemas);
            }
        }

    }
        
            






    












?>