<?php namespace Database;

    use Models\Location\City as City;
    use PDOException as PDOException;

    class CityDAO implements ICityDAO{
/*
        public function __construct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS cities(
                                zipCode INT NOT NULL AUTO_INCREMENT,
                                name VARCHAR(30),
                                provinceId INT,
                                CONSTRAINT pk_codigoPostal PRIMARY KEY(zipCode),
                                CONSTRAINT fk_idProvincia FOREIGN KEY (provinceId) REFERENCES provincias(provinceId)
                            )';
                $con->executeNonQuery($query);
            }catch(PDOException $e){
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }
*/
        function GetAll(){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT * FROM cities';
                $cities = $con->execute($query);
                return (!empty($cities)) ? $this->mapping($cities) : false;
            }catch(PDOException $e){
                throw $e;
            }
        }

        function Add($city){
            try {
                $con = Connection::getInstance();
                $query = 'INSERT INTO cities(zipCode, name, provinceId) VALUES(:zipCode,:name,:provinceId)';

                $province = $city->GetProvince();

                $params['zipCode'] = $city->GetZipCode();
                $params['name'] = $city->GetName();
                $params['provinceId'] = $province->GetId();
                
                return $con->executeNonQuery($query, $params);
            } catch (PDOException $e) {
                throw $e;
            }
        }
        
        function Delete($provinceId){}
        function Update($province){}
        
        function mapping($value){
            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new City((int)$p['zipCode'],$p['name'],(int)$p['provinceId']);
            },$value);
            return count($resp)>1 ? $resp : reset($resp);
        }

        public function GetByZipCode($zipCode){
            try {
                $query = 'SELECT * FROM cities as c 
                            WHERE c.zipCode = :zipCode';
                $con = Connection::getInstance();
                $params['zipCode'] = $zipCode;
                $city = $con->execute($query, $params);
                return (!empty($city)) ? $this->mapping($city) : array();
            } catch (PDOException $e) {
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }    
        }
    }

?>