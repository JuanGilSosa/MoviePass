<?php
    namespace DAO;

    use Models\Cine\Cine as Cine;

    interface ICineDAO
    {
        function Add(Cine $cine);
        function GetAll();
    }
?>