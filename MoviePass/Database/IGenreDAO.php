<?php 

    namespace Database;

    use Models\Movie\Genre as Genre;

    interface IGenreDAO
    {
        function GetAll();
        function Add(Genre $genre);
        function Delete($genreId);
        function Update(Genre $genre);
        function mapping($value);
    }

?>