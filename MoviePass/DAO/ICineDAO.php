<?php
    namespace DAO;

    use Cine\Cine as Cine;

    interface ICineDAO
    {
        function Add(Cine $cine);
        function GetAll();
    }
?>