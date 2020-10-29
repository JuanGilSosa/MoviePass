<?php namespace Database; 
    
    use Models\Ubicacion\Provincia as Provincia;

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
                $dir = new Direccion(
                    $p['id'],$p['nameProvincia'],$p['pais']);
                return $dir;
            },$value);
            return count($resp)>1 ? $resp : reset($resp);
        }

        public function GetById($idProvincia){
            try {
                $query = 'SELECT * FROM provincias as p 
                            WHERE p.idProvincia =='.$idProvincia.';';
                $con = Connection::getInstance();
                $provincia = $con->execute($query);
                return ((is_array($provincia))&&(!empty($provincia))) ? reset($provincia) : false;
            } catch (PDOException $e) {
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }     
        }

    }

?>