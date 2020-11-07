<?php 

    namespace Database;

    use Models\Location\City as City;

    interface ICityDAO
    {
        function GetAll();
        function Add(City $city);
        function Delete($cityId);
        function Update(City $city);
        function mapping($value);
    }

?>