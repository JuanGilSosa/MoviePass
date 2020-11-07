<?php 

    namespace Database;

    use Models\Theatre\Cinema as Cinema;

    interface ICinemaDAO
    {
        function GetAll();
        function Add(Cinema $cinema);
        function Delete($cinemaId);
        function Update(Cinema $cinema);
        function mapping($value);
    }

?>