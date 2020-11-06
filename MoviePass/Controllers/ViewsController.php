<?php

namespace Controllers;


use Database\TheatreDAO as TheatreDAO;
use Database\AdressDAO as AdressDAO;
use Database\CityDAO as CityDAO;
use Database\ProvinceDAO as ProvinceDAO;
use Database\CountryDAO as CountryDAO;
use Database\CinemaDAO as CinemaDAO;
use Database\MoviesDAO as MoviesDAO;
use DAO\GeneroDAO as GeneroDAO;

use Helpers\SessionHelper as SessionHelper;

class ViewsController
{
    private $theatreDAO;
    private $adressDAO;

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

    public static function ShowMoviesNowPlaying()
    {
        $genreDAO = new GeneroDAO();
        $genres = $genreDAO->GetAll();
        $moviesDAO = new MoviesDAO();
        $movies = $moviesDAO->GetAll();

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

    public static function ShowAddCinema($theatreId)
    {
        $theatreDAO = new TheatreDAO();
        $theatre = $theatreDAO->GetTheatreById($theatreId);
        require_once(VIEWS_PATH . 'addCinema.php');
    }

    public static function ShowCinemasByTheatre($theatreId)
    {
        $theatreDAO = new TheatreDAO();
        $theatre = $theatreDAO->GetTheatreById($theatreId);
        $cinemaDAO = new CinemaDAO();
        $cinemasByTheatre = $cinemaDAO->GetCinemasByTheatreId($theatreId);
        $cinemas = $cinemaDAO->ConvertToArray($cinemasByTheatre);

        require_once(VIEWS_PATH . 'cinemasByTheatre.php');
    }


    public static function ShowBillboard()
    {
        require_once(VIEWS_PATH . "billboard.php");
    }

    public static function ShowMovieDescription($movie, $trailerKey)
    {
        if (SessionHelper::isSession('adminLogged')) {
            $genresDAO = new GeneroDAO();
            $moviesDAO = new MoviesDAO();
            require_once(VIEWS_PATH . "moviesDescription.php");
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public static function ShowAddShowtimeView($message = "", $movieId = "", $theatre = "", $cinemas = "")
    {
        if (!empty($movieId)) {
            $moviesDAO = new MoviesDAO();
            $movie = $moviesDAO->GetMovieById($movieId);
            if (empty($theatre)) {
                $theatreDAO = new TheatreDAO();
                $theatres = $theatreDAO->GetAllActive();
            } else {
                $theatres = $theatre;
            }


            require_once(VIEWS_PATH . "addShowtime.php");
        }
    }
}
