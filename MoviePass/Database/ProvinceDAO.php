<?php namespace Database; 
    
    use Models\Location\Province as Province;
    use PDOException as PDOException;

    class ProvinceDAO implements IDAO{
/*
        public function __construct(){
            try {
                $con  = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS provinces(
                                provinceId INT NOT NULL AUTO_INCREMENT,
                                name VARCHAR(30) NOT NULL,
                                idPais INT,
                                CONSTRAINT pk_idProvincia PRIMARY KEY(provinceId),
                                CONSTRAINT fk_idPais FOREIGN KEY(idPais) REFERENCES paises(idPais)
                            )';    
            } catch (PDOException $e) {
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }
*/
        function GetAll(){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT * FROM provinces';
                $provinces = $con->execute($query);
                return (!empty($provinces)) ? $this->mapping($provinces) : false;
            }catch(PDOException $e){
                throw $e;
            }
        }

        function Add($province){}
        function Delete($provinceId){}
        function Update($province){}

        function mapping($value){
            $value = is_array($value) ? $value : [];
			$resp = array_map(function ($p){
                $dir = new Province(
                    $p['provinceId'],$p['name'],$p['countryId']);
                return $dir;
            },$value);
            return count($resp)>1 ? $resp : reset($resp);
        }

        public function GetById($provinceId){
            try {
                $query = 'SELECT * FROM provinces WHERE provinceId = :provinceId';
                $con = Connection::getInstance();
                $params['provinceId'] = $provinceId;
                $province = $con->execute($query,$params);
                return (!empty($province)) ? $this->mapping($province) : array();
            } catch (PDOException $e) {
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }     
        }
        
        public function GetByName($name){
            try {
                $query = 'SELECT * FROM provinces WHERE name = :name';
                $params['name'] = $name;
                $con = Connection::getInstance();
                $province = $con->execute($query, $params);
                return (!empty($province)) ? $this->mapping($province) : false;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
  
        }

    }

?>