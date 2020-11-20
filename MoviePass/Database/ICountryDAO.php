<?php 

    namespace Database;

    use Models\Location\Country as Country;

    interface ICountryDAO
    {
        function GetAll();
        function Add(Country $country);
        function Delete($countryId);
        function Update(Country $country);
        function mapping($value);
    }

?>