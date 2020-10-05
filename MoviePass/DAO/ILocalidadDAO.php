<?php
    namespace DAO;

    use Models\Ubicacion\Localidad as Localidad;

    interface ILocalidadDao
    {
        function Add(Localidad $localidad);
        function GetAll();
    }
?>