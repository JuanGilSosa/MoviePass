<?php

    namespace Controllers;

    use Database\ShowtimesDAO as ShowtimesDAO;
    use Database\MoviesDAO as MoviesDAO;
    use Database\TheatreDAO as TheatreDAO;
    use Controllers\ViewsController as ViewsController;
    use Controllers\TheatreController as TheatreController;
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
                

                ViewsController::ShowAddShowtimeView("", $movie->GetId(), $theatre, $cinemas);
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
                $theatres = $this->theatreDAO->GetAll();
                $cinemas = $this->cinemaDAO->GetAll();
                
                ViewsController::ShowAddShowtimeView("", $movieId, $theatres, $cinemas);
            }
        }

        
        public function AddFunctionToBillboard($theatre, $showtime){
            $billboard = $theatre->GetBillboard();
            $billboard->PushShowtime($showtime);
            $theatre->SetBillboard($billboard);

            return $theatre;
        }

        
        public function ShowShowtimes(){

            $theatreController = new TheatreController();

            $theatres = $this->theatreDAO->GetAllActive();
            $theatreAux = array();
            #$arrFunc = array();
            if(is_array($theatres) && !empty($theatres)){

                foreach ($theatres as $theatre) {

                    $theatre = $theatreController->CreateCine($theatre);
                    $roomAux = $this->cinemaDAO->GetCinemasByTheatreId($theatre->GetId()); #no verifico nada porque sea lo que sea, se va a setear en las salas del theatre
                    $theatre->SetCinemas($roomAux);
                    $objBillboard = $theatre->GetBillboard();
                   
                    if(!is_array($roomAux) && !empty($roomAux)){
                      
                        $func = $this->showtimeDAO->GetShowtime_showtimesxcinema($roomAux->GetId());
                       
                        if(!is_array($func) && !empty($func)){
                            $movie = $this->movieDAO->GetMovieById($func->GetMovie());
                            $func->SetCinema($roomAux);
                            $func->SetMovie($movie);
                            $objBillboard->PushShowtime($func);
                            #array_push($arrFunc, $func);
                       
                        }elseif(is_array($func) && !empty($func)){
                       
                            foreach($func as $f){
                                $movie = $this->movieDAO->GetMovieById($f->GetMovie());
                                $f->SetMovie($movie);
                                $f->SetCinema($roomAux);
                                $objBillboard->PushShowtime($f);
                                #array_push($arrFunc, $f);
                            }
                        }
                    
                    }elseif(is_array($roomAux) && !empty($roomAux)){
                    
                        foreach($roomAux as $cinema){
                            $func = $this->showtimeDAO->GetShowtime_showtimesxcinema($cinema->GetId());
                         
                            if(!is_array($func) && !empty($func)){
                                $movie = $this->movieDAO->GetMovieById($func->GetMovie());
                                $func->SetMovie($movie);
                                $func->SetCinema($cinema);
                                $objBillboard->PushShowtime($func);
                                #array_push($arrFunc, $func);
                         
                            }elseif(is_array($func) && !empty($func)){
                         
                                foreach($func as $f){
                                    $movie = $this->movieDAO->GetMovieById($f->GetMovie());
                                    $f->SetMovie($movie);
                                    $f->SetCinema($cinema);
                                    $objBillboard->PushShowtime($f);
                                    #array_push($arrFunc, $f);
                                }
                            }
                        }
                    }

                    #$objBillboard->setFunctions($arrFunc);
                    $theatre->SetBillboard($objBillboard);
                    array_push($theatreAux, $theatre);

                }
            
            }else{
            
                if(is_object($theatres)){
                    $theatres = $theatreController->CreateCine($theatres);
                    $roomAux = $this->cinemaDAO->GetCinemasByTheatreId($theatres->GetId());
                    $theatres->SetCinemas($roomAux);
                    $objBillboard = $theatres->GetBillboard();
                    $arrFunctions = array();

                    if(!is_array($roomAux) && !empty($roomAux)){

                        $func = $this->showtimeDAO->GetShowtime_showtimesxcinema($roomAux->GetId());
                        
                        if(!is_array($func) && !empty($func)){
                            $movie = $this->movieDAO->GetMovieById($func->GetMovie());
                            $func->SetMovie($movie);
                            $func->SetCinema($roomAux);
                            $objBillboard->PushShowtime($func);
                            #array_push($arrFunc, $func);
                   
                        }elseif(is_array($func) && !empty($func)){
                   
                            foreach($func as $f){
                                $movie = $this->movieDAO->GetMovieById($f->GetMovie());
                                $f->SetMovie($movie);
                                $f->SetCinema($roomAux);
                                $objBillboard->PushShowtime($f);
                                #array_push($arrFunc, $f);
                            }
                        }
                   
                    }elseif(!empty($roomAux) && is_array($roomAux)){
                   
                        foreach($roomAux as $cinema){
                            $func = $this->functionDAO->GetShowtime_showtimesxcinema($cinema->GetId());
                   
                            if(!is_array($func) && !empty($func)){
                                $movie = $this->movieDAO->GetMovieById($func->GetMovie());
                                $func->SetMovie($movie);
                                $func->SetCinema($cinema);
                                $objBillboard->PushShowtime($func);
                                #array_push($arrFunc, $func);
                   
                            }elseif(is_array($func) && !empty($func)){
                   
                                foreach($func as $f){
                                    $movie = $this->movieDAO->GetMovieById($f->GetMovie());
                                    $f->SetMovie($movie);
                                    $f->SetCinema($cinema);
                                    $objBillboard->PushShowtime($f);
                                    #array_push($arrFunc, $f);
                                }
                   
                            }
                   
                        }
                   
                    }

                    #$objBillboard->SetShowtime($arrFunc);
                    $theatres->SetBillboard($objBillboard);    
                    array_push($theatreAux, $theatres);
                }
                
            }
            ViewsController::ShowShowtimesView($theatreAux);   

        }
        

    }
        
            






    












?>