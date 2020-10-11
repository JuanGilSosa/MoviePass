<?php

    namespace DAO;

    use Models\Users\Admin;

    interface IDAO
    {
        function GetAll();
        function Add($user);
        function Delete($idUser);
        function Update($user);
    }



?>