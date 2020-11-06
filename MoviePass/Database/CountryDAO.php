<?php namespace Database; 

    use Models\Location\Country as Country;
    use PDOException as PDOException;

    class CountryDAO implements IDAO{
/*
        public function __construct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS countries(countryId INT NOT NULL AUTO_INCREMENT, name VARCHAR(30), CONSTRAINT pk_idPais PRIMARY KEY(countryId));';
                $con->executeNonQuery($query);
            }catch(PDOException $e){
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }
*/
        function GetAll(){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT * FROM countries';
                $countries = $con->execute($query);
                return (!empty($countries)) ? $this->mapping($countries) : false;
            }catch(PDOException $e){
                throw $e;
            }
        }

        function Add($country){
            try{
                $con = Connection::getInstance();

                $query = 'INSERT INTO countries(name) VALUES
                            (:name)';

                $params['name'] = $country->getNombre();
                
                return $con->executeNonQuery($query, $params);
            }catch(PDOException $e){
                throw $e;
            }
        }

        function Delete($countryId){}
        function Update($country){}

        function mapping($value){
            $value = is_array($value) ? $value : [];
            $return = array_map(function($p){
                return new Country($p['countryId'], $p['name']);
            },$value);
            return count($return)>1 ? $return : $return[0];
        }

        public function GetById($countryId){
            try {
                $query = 'SELECT * FROM countries WHERE countryId = :countryId';
                $con = Connection::getInstance();
                $params['countryId'] = $countryId;
                
                $country = $con->execute($query,$params);
                return (!empty($country)) ? $this->mapping($country) : false;
            } catch (PDOException $e) {
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }           
        }

        public function GetByName($name){
            try {
                $query = 'SELECT * FROM countries WHERE name = :name';
                $params['name'] = $name;
                $con = Connection::getInstance();
                $country = $con->execute($query, $params);
                return (!empty($country)) ? $this->mapping($country) : false;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

    }

?>