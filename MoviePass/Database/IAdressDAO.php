<?php 

    namespace Database;

    use Models\Location\Adress as Adress;

    interface IAdressDAO
    {
        function GetAll();
        function Add(Adress $adress);
        function Delete($adressId);
        function Update(Adress $adress);
        function mapping($value);
    }

?>