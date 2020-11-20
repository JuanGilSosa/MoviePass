<?php 

    namespace Database;

    use Models\Theatre\Theatre as Theatre;

    interface ITheatreDAO
    {
        function GetAll();
        function Add(Theatre $theatre);
        function Delete($theatreId);
        function Update(Theatre $theatre);
        function mapping($value);
    }

?>