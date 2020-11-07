<?php namespace Database;

    interface IDAO
    {
        function GetAll();
        function Add($objeto);
        function Delete($idObjeto);
        function Update($objeto);
        function mapping($value);
    }

?>