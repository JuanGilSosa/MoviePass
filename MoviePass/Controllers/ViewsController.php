<?php namespace Controllers;

        use Models\Cine\Cine as Cine;

        use DAO\CineDAO as CineDAO;
        use DAO\DireccionDAO as DireccionDAO;
        use DAO\CiudadDAO as CiudadDAO;
        use DAO\ProvinciaDAO as ProvinciaDAO;
        use DAO\PaisDAO as PaisDAO;
        use DAO\SalaDAO as SalaDAO;
        use DAO\PeliculaDAO as PeliculaDAO;
        use DAO\GeneroDAO as GeneroDAO;

        use Models\Ubicacion\Direccion as Direccion;
        use Models\Ubicacion\Ciudad as Ciudad;
        use Models\Ubicacion\Provincia as Provincia;
        use Models\Ubicacion\Pais as Pais;
        use Models\Cine\Sala as Sala;

    class ViewsController
    {
        private $cineDAO;
        private $direccionDAO;

        public static function ShowIndex()
        {
            require_once(VIEWS_PATH."addCine.php");            
        }

        public static function ShowLogIn($message = "")
        {
            $home = new HomeController();
            $home->Index($message);
        }

        public static function ShowRegisterForm($message = "")
        {
            require_once(VIEWS_PATH."registerForm.php");
        }

        public static function ShowAddCineView($message = "")
        {
            $paisDAO = new PaisDAO(); 
            $paises = $paisDAO->GetAll();
            
            $provinciaDAO = new ProvinciaDAO();
            $provincias = $provinciaDAO->GetAll();

            $ciudadDAO = new CiudadDAO();
            $ciudades = $ciudadDAO->GetAll();

            require_once(VIEWS_PATH."addCine.php");	         
        }

        public static function ShowCinesList($message = "")
        {
            if(SessionController::HayUsuario('adminLogged')){
                $cineDAO = new CineDAO();
                $cines = $cineDAO->GetAllActive();
            
                require_once(VIEWS_PATH."cinesList.php");
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
        
            require_once(VIEWS_PATH."listMovies.php");
        }


        public static function ShowMoviesListView($valueOfSelect = "")
        {
            $peliculasDAO = new PeliculaDAO();
            if($valueOfSelect != 0){
                $generoDAO = new GeneroDAO();
                $generos = $generoDAO->GetAll();
                $peliculas = $peliculasDAO->GetMoviesByGenre($valueOfSelect);
                require_once(VIEWS_PATH."listMovies.php");
            }else{
                $peliculas = $peliculasDAO->GetAll();
                require_once(VIEWS_PATH."listMovies.php");
            }


        }

        public static function ShowRegisterAdmin()
        {
            require_once(VIEWS_PATH."register-adm.php");
        }
        
        public static function ShowModifyCine($cineId, $message = "")
        {
            if(SessionController::HayUsuario('adminLogged')){
                $cineDAO = new CineDAO();
                $miCine = $cineDAO->getCineById($cineId);
                require_once(VIEWS_PATH."modifyCine.php");
            } else {

                ViewsController::ShowLogIn();
            }
        }
        
        public static function ShowAddSala()
        {
            require_once(VIEWS_PATH.'addSala.php');
        }

        public static function ShowCartelera()
        {
            require_once(VIEWS_PATH."cartelera.php");
        }

        public static function ShowMovieDescription($pelicula, $trailerKey)
        {
            $generosDAO = new GeneroDAO();
            $peliculasDAO = new PeliculaDAO();
            require_once(VIEWS_PATH."descriptionMovies.php");
        }
    }

?>