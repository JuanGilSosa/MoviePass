<?php

namespace Controllers;

use Database\ShowtimesDAO as ShowtimesDAO;
use Database\MoviesDAO as MoviesDAO;
use Database\TheatreDAO as TheatreDAO;
use Controllers\ViewsController as ViewsController;
use Controllers\TheatreController as TheatreController;
use Database\CinemaDAO as CinemaDAO;
use Database\GenreDAO as GenreDAO;
use Models\Movie\Showtime as Showtime;

class ShowtimeController
{

    private $showtimeDAO;
    private $theatreDAO;
    private $movieDAO;
    private $cinemaDAO;
    private $genreDAO;

    public function __construct()
    {
        $this->showtimeDAO = new ShowtimesDAO();
        $this->theatreDAO = new TheatreDAO();
        $this->movieDAO = new MoviesDAO();
        $this->cinemaDAO = new CinemaDAO();
        $this->genreDAO = new GenreDAO();
    }

    public function AddShowtime($theatreId = "", $cinemaId = "", $movieId = "",  $releaseDate = "", $startTime = "")
    {
        $message = "";

        if (!empty($theatreId) && !empty($cinemaId) && empty($movieId) && empty($startTime) && empty($releaseDate)) {
            // Acá estoy eligiendo la sala.
            $movieId = $cinemaId;
            $movie = $this->movieDAO->GetMovieById($movieId);
            $theatre = $this->theatreDAO->GetTheatreById($theatreId);
            $cinemas = $this->cinemaDAO->GetCinemasByTheatreId($theatreId);
            if (empty($cinemas)) { // El cine ingresado todavia no tiene salas cargadas.
                $message = "El cine ingresado no tiene salas disponibles.";
                ViewsController::ShowAddShowtimeView($message, $movie->GetId(), "", $cinemas);
            }
            ViewsController::ShowAddShowtimeView("", $movie->GetId(), $theatre, $cinemas);
        } else {
            $theatre = $this->theatreDAO->GetTheatreById($theatreId);
            $cinemas = $this->cinemaDAO->GetActiveCinemasByTheatreId($theatreId);
            $movie = $this->movieDAO->GetMovieById($movieId);

            // LA PELICULA ESTÁ EN ALGÚN CINE ESE DÍA?
            $existShowtime = $this->showtimeDAO->GetShowtimeXMovie($movieId);
            $wantedShowtime = $this->FindShowtimeXReleaseDate($existShowtime, $releaseDate);


            $cinemaIdShowtime = -1;
            if (!empty($wantedShowtime)) {
                $cinemaIdShowtime = $this->showtimeDAO->GetCinemaIdxShowtimeId($wantedShowtime->GetId());
            }


            if ($wantedShowtime == array() || $cinemaIdShowtime == $cinemaId) {
                // ACA ESTARIA CUANDO LA PELICULA NO EXISTE EN NINGUNA SALA EN ESE DIA. ENTONCES LO PUEDO GUARDAR
                // O LA FUNCION ESTA EN LA MISMA SALA EL MISMO DIA
                // VERIFICO QUE LA FECHA INGRESADA SEA MAYOR A HOY.
                $now = date("Y-m-d");
                if ($releaseDate >= $now) {
                    $runtime = $this->movieDAO->GetRuntime($movieId);
                    $startTimeSeconds = strtotime($startTime);
                    $runtimeSeconds = $runtime * 60;
                    $endTime = date("H:i", $startTimeSeconds + $runtimeSeconds);
                    $newEndTime = $this->AddMinutes($endTime);

                    $theatre = $this->theatreDAO->GetTheatreById($theatreId);
                    $cinema = $this->cinemaDAO->GetCinemaById($cinemaId);

                    // AHORA TENGO QUE VERIFICAR LA HORA DE INICIO Y LA HORA DE FINAL
                    $checkTime = $this->CheckTime($cinemaId, $releaseDate, $startTime, $newEndTime);


                    if ($checkTime == "ok") {

                        $showtime = new Showtime(0, $movie, $startTime, $endTime, $releaseDate, $cinema);
                        //var_dump($showtime);
                        $this->showtimeDAO->Add($showtime);

                        $showtimeLastId = $this->showtimeDAO->GetLastId(); #uso esto porque como el objeto tiene 0 - no sirve
                        $cinemaId = $cinema->GetId();
                        $this->showtimeDAO->Add_showtimesXcinemas($cinemaId, $showtimeLastId);

                        $movieInDb = $this->movieDAO->GetMovieByIdFromDatabase($movie->GetId());
                        if (empty($movieInDb)) {

                            $this->movieDAO->AddToDatabase($movie);
                            $genresIds = $movie->GetGenres();
                            //var_dump($genresIds);
                            foreach ($genresIds as $genreId) {
                                $this->genreDAO->Add_genresXmovies($genreId, $movie->GetId());
                            }
                        }

                        $message = "Función agregada con éxito";
                        $this->ShowShowtimes($message);
                    } else {
                        // LA SALA NO ESTÁ DISPONIBLE PORQUE FALLA LA VALIDACION DE TIEMPO.
                        $message = $checkTime; // PARA QUE NO CONFUNDIRNOS IGUALO EL MENSAJE CON CHECKTIME.
                        ViewsController::ShowAddShowtimeView($message, $movieId, $theatre, $cinemas);
                    }
                } else {
                    $now = date("d-m-Y");
                    $message = "La fecha de comienzo no puede ser anterior a: " . $now;
                    ViewsController::ShowAddShowtimeView($message, $movieId, $theatre, $cinemas);
                }
            } else {

                $message = "La película ingresada ya se encuentra en una función el día ingresado.";
                ViewsController::ShowAddShowtimeView($message, $movieId, $theatre, $cinemas);
            }
        }
    }

    private function FindShowtimeXReleaseDate($showtimes, $releaseDate)
    {
        if (!empty($showtimes) && is_array($showtimes)) {
            foreach ($showtimes as $showtime) {
                if ($showtime->GetReleaseDate() == $releaseDate) {
                    return $showtime;
                }
            }
        } else if (!empty($showtimes)) {
            if ($showtimes->GetReleaseDate() == $releaseDate)
                return $showtimes;
        } else {
            return array();
        }
    }

    private function CheckTime($cinemaId, $releaseDate, $startTime, $newEndTime)
    {

        // SHOWTIMES nos da todas las funciones de la sala.
        $showtimes = $this->showtimeDAO->GetShowtime_showtimesxcinema($cinemaId);
        $messageCheckTime = "";

        if (!empty($showtimes)) {
            if (is_array($showtimes)) {
                foreach ($showtimes as $showtime) {
                    if ($showtime->GetReleaseDate() == $releaseDate) {
                        $endTime = $showtime->GetEndTime();
                        $newEndTimeShowtime = $this->AddMinutes($endTime);
                        // Verifico que la hora del final con los 15 minutos ya sumados sean menores a la hora de comienzo de la funcion



                        if ($startTime > $showtime->GetStartTime()) {
                            if ($startTime > $newEndTimeShowtime) {
                                $messageCheckTime = "ok";
                            } else {
                                // HAY FUNCION EN CURSO

                                $messageCheckTime = "El horario de comienzo no se encuentra disponible.";
                            }
                        } else if ($startTime < $showtime->GetStartTime()) {

                            if ($this->AddMinutes($endTime) < $showtime->GetStartTime()) {
                                $messageCheckTime = "ok";
                            } else {
                                $messageCheckTime = "El horario de comienzo no se encuentra disponible.";
                            }
                        } else {

                            $messageCheckTime = "El horario de comienzo no se encuentra disponible.";
                        }
                    } else {
                        // SIGNIFICA QUE LA SALA TIENE FUNCIONES PERO NO PARA ESE DÍA. PUEDO GRABAR
                        $messageCheckTime = "ok";
                    }
                }
                return $messageCheckTime;
            } else { // ES PORQUE HAY SOLAMENTE UNA FUNCION

                if ($showtimes->GetReleaseDate() == $releaseDate) {

                    $endTime = $showtimes->GetEndTime();
                    $newEndTimeShowtime = $this->AddMinutes($endTime);
                    // Verifico que la hora del final con los 15 minutos ya sumados sean menores a la hora de comienzo de la funcion

                    if ($startTime > $showtimes->GetStartTime()) {
                        if ($startTime > $newEndTimeShowtime) {
                            $messageCheckTime = "ok";
                        } else {
                            // HAY FUNCION EN CURSO
                            $messageCheckTime = "El horario de comienzo no se encuentra disponible.";
                        }
                    } else if ($startTime < $showtimes->GetStartTime()) {

                        if ($this->AddMinutes($endTime) < $showtimes->GetStartTime()) {
                            $messageCheckTime = "ok";
                        } else {
                            $messageCheckTime = "El horario de comienzo no se encuentra disponible.";
                        }
                    } else {
                        $messageCheckTime = "El horario de comienzo no se encuentra disponible.";
                    }
                } else {
                    $messageCheckTime = "ok";
                }
                return $messageCheckTime;
            }
        } else {
            // NO HAY NINGUNA FUNCION PARA ESE DIA EN ESA SALA.
            $messageCheckTime = "ok";
            return $messageCheckTime;
        }
    }

    private function FindMovieInCinema($movieId, $releaseDate)
    {
        $showtime = $this->showtimeDAO->GetShowTimeXMovie($movieId, $releaseDate);
        return $showtime;
    }

    private function AddMinutes($endTime)
    {
        $newEndTime = date("H:i", strtotime($endTime) + (TIME_BETWEEN_MOVIES * 60));
        return $newEndTime;
    }

    public function ShowAddShowtime($movieId)
    {
        $movie = $this->movieDAO->GetMovieById($movieId);
        if (!is_null($movie)) {
            $theatres = $this->theatreDAO->GetAll();
            $cinemas = $this->cinemaDAO->GetAll();

            ViewsController::ShowAddShowtimeView("", $movieId, $theatres, $cinemas);
        }
    }


    public function AddFunctionToBillboard($theatre, $showtime)
    {
        $billboard = $theatre->GetBillboard();
        $billboard->PushShowtime($showtime);
        $theatre->SetBillboard($billboard);

        return $theatre;
    }


    public function ShowShowtimes($message = "")
    {
        $theatreController = new TheatreController();

        $theatres = $this->theatreDAO->GetAllActive();
        //var_dump($theatres);

        $theatreAux = array();
        #$arrFunc = array();

        if (is_array($theatres) && !empty($theatres)) {

            foreach ($theatres as $theatre) {
                $theatre = $theatreController->CreateCine($theatre);
                $roomAux = $this->cinemaDAO->GetCinemasByTheatreId($theatre->GetId()); #no verifico nada porque sea lo que sea, se va a setear en las salas del theatre
                $theatre->SetCinemas($roomAux);
                $objBillboard = $theatre->GetBillboard();

                if (!is_array($roomAux) && !empty($roomAux)) {

                    $func = $this->showtimeDAO->GetShowtime_showtimesxcinema($roomAux->GetId());

                    //var_dump($func);

                    if (!is_array($func) && !empty($func)) {
                        
                            $movie = $this->movieDAO->GetMovieById($func->GetMovie());
                            $func->SetCinema($roomAux);
                            $func->SetMovie($movie);
                            $objBillboard->PushShowtime($func);
                            #array_push($arrFunc, $func);
                        
                    } elseif (is_array($func) && !empty($func)) {

                        foreach ($func as $f) {
                                                      
                            
                                $movie = $this->movieDAO->GetMovieById($f->GetMovie());
                                $f->SetMovie($movie);
                                $f->SetCinema($roomAux);
                                $objBillboard->PushShowtime($f);
                                #array_push($arrFunc, $f);
                            
                        }
                    }
                } elseif (is_array($roomAux) && !empty($roomAux)) {

                    foreach ($roomAux as $cinema) {
                        $func = $this->showtimeDAO->GetShowtime_showtimesxcinema($cinema->GetId());

                        if (!is_array($func) && !empty($func)) {
                            $movie = $this->movieDAO->GetMovieById($func->GetMovie());
                            $func->SetMovie($movie);
                            $func->SetCinema($cinema);
                            $objBillboard->PushShowtime($func);
                            #array_push($arrFunc, $func);

                        } elseif (is_array($func) && !empty($func)) {

                            foreach ($func as $f) {
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
        } else {

            if (is_object($theatres)) {
                $theatres = $theatreController->CreateCine($theatres);
                $roomAux = $this->cinemaDAO->GetCinemasByTheatreId($theatres->GetId());
                $theatres->SetCinemas($roomAux);
                $objBillboard = $theatres->GetBillboard();
                $arrFunctions = array();

                if (!is_array($roomAux) && !empty($roomAux)) {

                    $func = $this->showtimeDAO->GetShowtime_showtimesxcinema($roomAux->GetId());

                    if (!is_array($func) && !empty($func)) {
                        $movie = $this->movieDAO->GetMovieById($func->GetMovie());
                        $func->SetMovie($movie);
                        $func->SetCinema($roomAux);
                        $objBillboard->PushShowtime($func);
                        #array_push($arrFunc, $func);

                    } elseif (is_array($func) && !empty($func)) {

                        foreach ($func as $f) {
                            $movie = $this->movieDAO->GetMovieById($f->GetMovie());
                            $f->SetMovie($movie);
                            $f->SetCinema($roomAux);
                            $objBillboard->PushShowtime($f);
                            #array_push($arrFunc, $f);
                        }
                    }
                } elseif (!empty($roomAux) && is_array($roomAux)) {

                    foreach ($roomAux as $cinema) {
                        $func = $this->showtimeDAO->GetShowtime_showtimesxcinema($cinema->GetId());

                        if (!is_array($func) && !empty($func)) {
                            $movie = $this->movieDAO->GetMovieById($func->GetMovie());
                            $func->SetMovie($movie);
                            $func->SetCinema($cinema);
                            $objBillboard->PushShowtime($func);
                            #array_push($arrFunc, $func);

                        } elseif (is_array($func) && !empty($func)) {

                            foreach ($func as $f) {
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

        $billboard = array();

        //var_dump($theatreAux);
        
        ViewsController::ShowShowtimesView($message, $theatreAux);
    }

}
