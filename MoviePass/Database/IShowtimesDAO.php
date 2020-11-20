<?php 

    namespace Database;

    use Models\Movie\Showtime as Showtime;

    interface IShowtimesDAO
    {
        function GetAll();
        function Add(Showtime $showtime);
        function Delete($showtimeId);
        function Update(Showtime $showtime);
        function mapping($value);
    }

?>