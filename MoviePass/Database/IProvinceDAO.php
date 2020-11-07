<?php 

    namespace Database;

    use Models\Location\Province as Province;

    interface IAdressDAO
    {
        function GetAll();
        function Add(Province $province);
        function Delete($provinceId);
        function Update(Province $province);
        function mapping($value);
    }

?>