<?php
    namespace Controllers;

    use DAO\PeliculaDAO as PeliculaDAO;
    class HomeController
    {
        public static function Index($message = "")
        {
            $peliculasDAO = new PeliculaDAO();
            $upcomingMovies = $peliculasDAO->GetUpcomingMovies();
            $topRatedMovies = $peliculasDAO->GetPopular();
            require_once(VIEWS_PATH."main.php");
        }        
        
    }
?>