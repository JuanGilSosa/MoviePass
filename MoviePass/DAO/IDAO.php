<?php

    namespace DAO;

    interface IDAO
    {
        function GetAll();
        function Add($objeto);
        function Delete($idObjeto);
        function Update($objeto);
    }

?>