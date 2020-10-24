<?php namespace Controllers;

    class ViewsController
    {
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

        public static function ShowCinesList($cines)
        {
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
        
        public static function ShowModifyCine($miCine)
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