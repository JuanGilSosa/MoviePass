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
        $countryDAO = new CountryDAO();
        $countries = $countryDAO->GetAll();

        $provinceDAO = new ProvinceDAO();
        $provinces = $provinceDAO->GetAll();

        $cityDAO = new CityDAO();
        $cities = $cityDAO->GetAll();

        require_once(VIEWS_PATH . "addTheatre.php");
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

    public static function ShowAddCinema($theatreId, $message="")
    {
        $theatreDAO = new TheatreDAO();
        $theatre = $theatreDAO->GetTheatreById($theatreId);
        require_once(VIEWS_PATH . 'addCinema.php');
    }

    public static function ShowCinemasByTheatre($theatreId, $message="")
    {
        $theatreDAO = new TheatreDAO();
        $theatre = $theatreDAO->GetTheatreById($theatreId);
        $cinemaDAO = new CinemaDAO();
        $cinemasByTheatre = $cinemaDAO->GetActiveCinemasByTheatreId($theatreId);
        $cinemas = $cinemaDAO->ConvertToArray($cinemasByTheatre);

        require_once(VIEWS_PATH . 'cinemasByTheatre.php');
    }

    public static function ShowModifyCinema($cinemaId, $message="")
    {
        if (SessionHelper::isSession('adminLogged')) {
            $cinemaDAO = New CinemaDAO();
            $cinema = $cinemaDAO->GetCinemaById(intval($cinemaId));
            require_once(VIEWS_PATH . 'modifyCinema.php');
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

    public static function ShowShowtimesView($message, $cinemas){
        $theatreDAO = new TheatreDAO();
        #$genreDAO = new GenreDAO();
        $billboards = array();
        if(is_array($cinemas)){
            foreach($cinemas as $cinema){
                array_push($billboards, $cinema->GetBillboard());
            }
        }else{
            array_push($billboards, $cinemas->GetBillboard());
        }
        require_once(VIEWS_PATH . "showtimes.php");
    }

    public static function ShowCartView($message = ""/*$myCart*/){
        require_once(VIEWS_PATH.'listCart.php');
    }

}
