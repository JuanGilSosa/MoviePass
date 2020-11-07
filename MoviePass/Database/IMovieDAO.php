<?php 

    namespace Database;

    use Models\Movie\Movie as Movie;

    interface IMovieDAO
    {
        function GetAll();
        function Add(Movie $movie);
        function Delete($movieId);
        function Update(Movie $movie);
        function mapping($value);
    }

?>