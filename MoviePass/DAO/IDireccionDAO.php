<?php
    namespace DAO;

    use Models\Ubicacion\Direccion as Direccion;

    interface IDireccionDao
    {
        function Add(Direccion $direccion);
        function GetAll();
    }
?>