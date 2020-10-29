<?php namespace Database; 
    
    use Models\Ubicacion\Provincia as Provincia;
    use Models\Ubicacion\Direccion as Direccion;

    class ProvinciaDAO implements IDAO{
/*
        public function __construct(){
            try {
                $con  = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS provincias(
                                idProvincia INT NOT NULL AUTO_INCREMENT,
                                nameProvincia VARCHAR(30) NOT NULL,
                                idPais INT,
                                CONSTRAINT pk_idProvincia PRIMARY KEY(idProvincia),
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
                $query = 'SELECT * FROM provincias';
                $provincias = $con->execute($query);
                return $provincias;
            }catch(PDOException $e){
                throw $e;
            }
        }

        function Add($objeto){}
        function Delete($idObjeto){}
        function Update($objeto){}

        function mapping($value){
            $value = is_array($value) ? $value : [];
			$resp = array_map(function ($p){
                $dir = new Provincia(
                    $p['idProvincia'],$p['nameProvincia'],$p['idPais']);
                return $dir;
            },$value);
            return count($resp)>1 ? $resp : reset($resp);
        }

        public function GetById($idProvincia){
            try {
                $query = 'SELECT * FROM provincias WHERE idProvincia = :idProvincia';
                $con = Connection::getInstance();
                $params['idProvincia'] = $idProvincia;
                $provincia = $con->execute($query,$params);
                return (!empty($provincia)) ? $this->mapping($provincia) : false;
            } catch (PDOException $e) {
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }     
        }
        
        public function GetByName($nameProvincia){
            try {
                $query = 'SELECT * FROM provincias WHERE nameProvincia = :nameProvincia';
                $params['nameProvincia'] = $nameProvincia;
                $con = Connection::getInstance();
                $provincia = $con->execute($query, $params);
                return (!empty($provincia)) ? $this->mapping($provincia) : false;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
  
        }

    }

?>