<?php
    namespace Controllers;

    use Database\MoviesDAO as MoviesDAO;
    class HomeController
    {
        public static function Index($message = "")
        {
            $moviesDAO = new MoviesDAO();
            $upcomingMovies = $moviesDAO->GetUpcomingMovies();
            $topRatedMovies = $moviesDAO->GetPopular();
            require_once(VIEWS_PATH."main.php");
        }        
        
    }
?>