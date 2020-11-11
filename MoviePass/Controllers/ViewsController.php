<?php

namespace Controllers;


use Database\TheatreDAO as TheatreDAO;
use Database\AdressDAO as AdressDAO;
use Database\CityDAO as CityDAO;
use Database\ProvinceDAO as ProvinceDAO;
use Database\CountryDAO as CountryDAO;
use Database\CinemaDAO as CinemaDAO;
use Database\MoviesDAO as MoviesDAO;
use Database\GenreDAO as GenreDAO;

use Helpers\SessionHelper as SessionHelper;
use DateTime as DateTime;
use Models\Location\City;

class ViewsController
{
    public static function ShowIndex()
    {
        HomeController::Index();
    }

    public static function ShowLogIn($message = "")
    {
        require_once(VIEWS_PATH . "loginForm.php");
    }

    public static function ShowRegisterForm($message = "")
    {
        require_once(VIEWS_PATH . "registerForm.php");
    }

    public static function ShowAddTheatre($message = "")
    {
        if (SessionHelper::isSession('adminLogged')) {
            $countryDAO = new CountryDAO();
            $countries = $countryDAO->GetAll();

            $provinceDAO = new ProvinceDAO();
            $provinces = $provinceDAO->GetAll();

            $cityDAO = new CityDAO();
            $cities = $cityDAO->GetAll();

            require_once(VIEWS_PATH . "addTheatre.php");
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public static function ShowTheatres($theatres, $message = "")
    {
        if (SessionHelper::isSession('adminLogged')) {
            require_once(VIEWS_PATH . "theatres.php");
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public static function ShowAllTheatres($theatres = "", $message = "")
    {
        if (SessionHelper::isSession('adminLogged')) {
            require_once(VIEWS_PATH . "allTheatres.php");
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public static function ShowMoviesNowPlaying()
    {
        $genreDAO = new GenreDAO();

        $moviesDAO = new MoviesDAO();
        $movies = $moviesDAO->GetAll();

        $genres = $genreDAO->GetGenresFromMoviesNowPlaying($movies);

        require_once(VIEWS_PATH . "movies.php");
    }


    public static function ShowMoviesListView($message, $movies, $genres)
    {
        require_once(VIEWS_PATH . "movies.php");
    }

    public static function ShowRegisterAdmin($message = "")
    {
        require_once(VIEWS_PATH . "register-adm.php");
    }

    public static function ShowModifyTheatre($theatreId, $message = "")
    {
        if (SessionHelper::isSession('adminLogged')) {
            $theatreDAO = new TheatreDAO();
            $theatre = $theatreDAO->GetTheatreById(strval($theatreId));

            $countryDAO = new CountryDAO();
            $countries = $countryDAO->GetAll();

            $provinceDAO = new ProvinceDAO();
            $provinces = $provinceDAO->GetAll();

            $cityDAO = new CityDAO();
            $cities = $cityDAO->GetAll();

            $adressDAO = new AdressDAO();
            $adress = $adressDAO->GetAdressById($theatre->GetAdress());

            require_once(VIEWS_PATH . "modifyTheatre.php");
        } else {

            ViewsController::ShowLogIn();
        }
    }

    public static function ShowAddCinema($theatreId, $message = "")
    {
        if (SessionHelper::isSession('adminLogged')) {
            $theatreDAO = new TheatreDAO();
            $theatre = $theatreDAO->GetTheatreById($theatreId);
            require_once(VIEWS_PATH . 'addCinema.php');
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public static function ShowCinemasByTheatre($theatreId, $message = "")
    {
        $theatreDAO = new TheatreDAO();
        $theatre = $theatreDAO->GetTheatreById($theatreId);
        $cinemaDAO = new CinemaDAO();
        $cinemasByTheatre = $cinemaDAO->GetActiveCinemasByTheatreId($theatreId);
        $cinemas = $cinemaDAO->ConvertToArray($cinemasByTheatre);

        require_once(VIEWS_PATH . 'cinemasByTheatre.php');
    }

    public static function ShowModifyCinema($cinemaId, $message = "")
    {
        if (SessionHelper::isSession('adminLogged')) {
            $cinemaDAO = new CinemaDAO();
            $cinema = $cinemaDAO->GetCinemaById(intval($cinemaId));
            require_once(VIEWS_PATH . 'modifyCinema.php');
        } else {
            ViewsController::ShowLogIn();
        }
    }


    public static function ShowBillboard()
    {
        require_once(VIEWS_PATH . "billboard.php");
    }

    public static function ShowMovieDescription($movie, $trailerKey)
    {
        if (!empty($movie) && !empty($trailerKey)) {
            $genresDAO = new GenreDAO();
            $moviesDAO = new MoviesDAO();
            require_once(VIEWS_PATH . "moviesDescription.php");
        } else {
            ViewsController::ShowIndex();
        }
    }

    public static function ShowAddShowtimeView($message = "", $movieId = "", $theatres = "", $cinemas = "")
    {
        if (!empty($movieId)) {
            $moviesDAO = new MoviesDAO();
            $movie = $moviesDAO->GetMovieById($movieId);
            if (empty($theatres)) {
                $theatreDAO = new TheatreDAO();
                $theatres = $theatreDAO->GetAllActive();
            }

            require_once(VIEWS_PATH . "addShowtime.php");
        }
    }

    public static function ShowShowtimesView($message, $theatres)
    {
        $theatreDAO = new TheatreDAO();
        #$genreDAO = new GenreDAO();

        $billboards = array();

        if (is_array($theatres)) {
            foreach ($theatres as $theatre) {
                $cinemaBillboard = $theatre->GetBillboard();


                $now = date("Y-m-d");
                $oneMoreWeek = date("Y-m-d", strtotime($now . ("+1 week")));

                $dateNow = DateTime::createFromFormat('Y-m-d', $now);
                $dateOneMoreWeek = DateTime::createFromFormat('Y-m-d', $oneMoreWeek);


                if (is_object($cinemaBillboard)) {
                    $showtimes = $cinemaBillboard->GetShowtime();

                    if (is_array($showtimes)) {

                        foreach ($showtimes as $showtime) {
                            
                            $dateReleaseDate =  DateTime::createFromFormat('Y-m-d', $showtime->GetReleaseDate());

                          

                            if ($dateNow < $dateReleaseDate && $dateOneMoreWeek > $dateReleaseDate) {
                                //var_dump($dateReleaseDate);
                                array_push($billboards, $showtime);
                            }
                        }
                    } else if (is_object($showtimes)) {
                        $dateReleaseDate =  DateTime::createFromFormat('Y-m-d', $showtimes->GetReleaseDate());

                        if ($dateNow < $dateReleaseDate && $dateOneMoreWeek > $dateReleaseDate) {
                            array_push($billboards, $showtimes);
                        }
                    }
                }
            }
        } else if(is_object($theatres)){

            $cinemaBillboard = $theatres->GetBillboard();


                $now = date("Y-m-d");
                $oneMoreWeek = date("Y-m-d", strtotime($now . ("+1 week")));

                $dateNow = DateTime::createFromFormat('Y-m-d', $now);
                $dateOneMoreWeek = DateTime::createFromFormat('Y-m-d', $oneMoreWeek);


                if (is_object($cinemaBillboard)) {
                    $showtimes = $cinemaBillboard->GetShowtime();

                    if (is_array($showtimes)) {

                        foreach ($showtimes as $showtime) {
                            
                            $dateReleaseDate =  DateTime::createFromFormat('Y-m-d', $showtime->GetReleaseDate());

                          

                            if ($dateNow < $dateReleaseDate && $dateOneMoreWeek > $dateReleaseDate) {
                                //var_dump($dateReleaseDate);
                                array_push($billboards, $showtime);
                            }
                        }
                    } else if (is_object($showtimes)) {
                        $dateReleaseDate =  DateTime::createFromFormat('Y-m-d', $showtimes->GetReleaseDate());

                        if ($dateNow < $dateReleaseDate && $dateOneMoreWeek > $dateReleaseDate) {
                            array_push($billboards, $showtimes);
                        }
                    }
                }
                
        }
        require_once(VIEWS_PATH . "showtimes.php");
    }

    public static function ShowCartView($message = ""/*$myCart*/)
    {
        $theatreDAO = new TheatreDAO();

        require_once(VIEWS_PATH . 'listCart.php');
    }

    public static function ShowProcessOrderView()
    {
        require_once(VIEWS_PATH . 'payment.php');
    }

    public static function ShowTicketsListView($tickets, $message = "")
    {
        $theatreDAO = new TheatreDAO();
        $adressDAO = new AdressDAO();
        $cityDAO = new CityDAO();
        require_once(VIEWS_PATH . 'ticketsList.php');
    }
    
    public static function ShowStatsTheatreView($total=0, $countOfTickets=0, $remainder=0){
        $theatreDAO = new TheatreDAO();
        $theatres = $theatreDAO->GetAllActive();
        require_once(VIEWS_PATH . 'statsTheatre.php');
    }
}
