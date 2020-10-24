<?php namespace Controllers;

        use Models\Cine\Cine as Cine;

        use DAO\CineDAO as CineDAO;
        use DAO\DireccionDAO as DireccionDAO;
        use DAO\CiudadDAO as CiudadDAO;
        use DAO\ProvinciaDAO as ProvinciaDAO;
        use DAO\PaisDAO as PaisDAO;
        use DAO\SalaDAO as SalaDAO;

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
            require_once(FRONT_ROOT."index.php");            
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
            require_once(VIEWS_PATH."addCine.php");
        }

        public static function ShowCinesList()
        {
            $cineDAO = new CineDAO();
            $cines = $cineDAO->GetAllActive();
            $direccionDAO = new DireccionDAO(); 
            $ciudadDAO = new CiudadDAO();
            $provinciaDAO = new ProvinciaDAO();
            $paisDAO = new PaisDAO();
            require_once(VIEWS_PATH."cinesList.php");
        }

        public static function ShowMoviesListView()
        {
            require_once(VIEWS_PATH."listMovies.php");
        }

        public static function ShowRegisterAdmin()
        {
            require_once(VIEWS_PATH."register-adm.php");
        }
        
        public static function ShowModifyCine($miCine, $message = "")
        {
            require_once(VIEWS_PATH."modifyCine.php");
        }
        
        public static function ShowAddSala()
        {
            require_once(VIEWS_PATH.'addSala.php');
        }

        public static function ShowCartelera()
        {
            require_once(VIEWS_PATH."cartelera.php");
        }
    }

?>