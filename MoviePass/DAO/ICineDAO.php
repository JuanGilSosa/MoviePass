<?php
    namespace DAO;

    use Models\Theater as Theater;

    interface ITheaterDAO
    {
        function Add(Theater $theater);
        function GetAll();
    }
?>