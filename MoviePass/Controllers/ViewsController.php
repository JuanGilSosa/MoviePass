<?php

namespace Controllers;


use Database\CineDAO as CineDAO;
use Database\DireccionDAO as DireccionDAO;
use Database\CiudadDAO as CiudadDAO;
use Database\ProvinciaDAO as ProvinciaDAO;
use Database\PaisDAO as PaisDAO;
use Database\SalaDAO as SalaDAO;
use DAO\PeliculaDAO as PeliculaDAO;
use DAO\GeneroDAO as GeneroDAO;
/*
        use DAO\CineDAO as CineDAO;
        use DAO\DireccionDAO as DireccionDAO;
        use DAO\CiudadDAO as CiudadDAO;
        use DAO\ProvinciaDAO as ProvinciaDAO;
        use DAO\PaisDAO as PaisDAO;
        use DAO\SalaDAO as SalaDAO;
        use DAO\PeliculaDAO as PeliculaDAO;
        use DAO\GeneroDAO as GeneroDAO;
        */
use Models\Ubicacion\Direccion as Direccion;
use Models\Ubicacion\Ciudad as Ciudad;
use Models\Ubicacion\Provincia as Provincia;
use Models\Ubicacion\Pais as Pais;
use Models\Cine\Sala as Sala;
use Models\Cine\Cine as Cine;

use Helpers\SessionHelper as SessionHelper;

class ViewsController
{
    private $cineDAO;
    private $direccionDAO;

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

    public static function ShowAddCineView($message = "")
    {
        $paisDAO = new PaisDAO();
        $paises = $paisDAO->GetAll();

        $provinciaDAO = new ProvinciaDAO();
        $provincias = $provinciaDAO->GetAll();

        $ciudadDAO = new CiudadDAO();
        $ciudades = $ciudadDAO->GetAll();

        require_once(VIEWS_PATH . "addCine.php");
    }

    public static function ShowCinesList($cines, $message = "")
    {
        if (SessionHelper::HayUsuario('adminLogged')) {
            require_once(VIEWS_PATH . "cinesList.php");
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public static function ShowMoviesNowPlaying()
    {
        $generoDAO = new GeneroDAO();
        $generos = $generoDAO->GetAll();
        $peliculasDAO = new PeliculaDAO();
        $peliculas = $peliculasDAO->GetAll();

        require_once(VIEWS_PATH . "listMovies.php");
    }


    public static function ShowMoviesListView($message, $peliculas, $generos)
    {
        require_once(VIEWS_PATH . "listMovies.php");
    }

    public static function ShowRegisterAdmin($message = "")
    {
        require_once(VIEWS_PATH . "register-adm.php");
    }

    public static function ShowModifyCine($cineId, $message = "")
    {
        if (SessionHelper::HayUsuario('adminLogged')) {
            $cineDAO = new CineDAO();
            $miCine = $cineDAO->getCineById(strval($cineId));
            require_once(VIEWS_PATH . "modifyCine.php");
        } else {

            ViewsController::ShowLogIn();
        }
    }

    public static function ShowAddSala($idCine)
    {
        $cineDAO = new CineDAO();
        $cine = $cineDAO->GetCineById($idCine);
        require_once(VIEWS_PATH . 'addSala.php');
    }

    public static function ShowSalasPorCine($idCine)
    {
        $cineDAO = new CineDAO();
        $cine = $cineDAO->GetCineById($idCine);
        $salaDAO = new SalaDAO();
        $salasPorCine = $salaDAO->GetSalasByCineId($idCine);
        $salas = $salaDAO->ConvertToArray($salasPorCine);
        require_once(VIEWS_PATH . 'salasPorCine.php');
    }


    public static function ShowCartelera()
    {
        require_once(VIEWS_PATH . "cartelera.php");
    }

    public static function ShowMovieDescription($pelicula, $trailerKey)
    {
        if (SessionHelper::HayUsuario('adminLogged')) {
            $generosDAO = new GeneroDAO();
            $peliculasDAO = new PeliculaDAO();
            require_once(VIEWS_PATH . "descriptionMovies.php");
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public static function ShowAddFuncionView($message = "", $peliculaId = "", $cine = "", $salas = "")
    {
        if (!empty($peliculaId)) {
            $peliculasDAO = new PeliculaDAO();
            $pelicula = $peliculasDAO->getMovieById($peliculaId);
            if(empty($cine)){
                $cineDAO = new CineDAO();
                $cines = $cineDAO->GetAllActive();
            }else{
                $cines = $cine;
            }
            

            require_once(VIEWS_PATH . "addFuncion.php");
        }
    }

    public static function ShowListFunctionsView($cinemas){
        $billboards = array();
        if(is_array($cinemas)){
            foreach($cinemas as $cinema){
                array_push($billboards,$cinema->getBillboard());
            }
        }else{
            array_push($billboards, $cinemas->getBillboard());
        }
    
        require_once(VIEWS_PATH . "listFunctions.php");
    }
}
