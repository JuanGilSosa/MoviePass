<?php 
    namespace DAO;
    use Models\Ubicacion\Pais as Pais;
    interface IPaisDAO{
        function Add(Pais $pais);
        function GetAll();
    }
?>