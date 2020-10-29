<?php namespace Database;

    use Models\Ubicacion\Ciudad as Ciudad;

    class CiudadDAO implements IDAO{
/*
        public function __construct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS ciudades(
                                codigoPostal INT NOT NULL AUTO_INCREMENT,
                                nameCiudad VARCHAR(30),
                                idProvincia INT,
                                CONSTRAINT pk_codigoPostal PRIMARY KEY(codigoPostal),
                                CONSTRAINT fk_idProvincia FOREIGN KEY (idProvincia) REFERENCES provincias(idProvincia)
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
                $query = 'SELECT * FROM ciudades';
                $paises = $con->execute($query);
                return $paises;
            }catch(PDOException $e){
                throw $e;
            }
        }

        function Add($ciudad){
            try {
                $con = Connection::getInstance();
                $query = 'INSERT INTO ciudades(codigoPostal, nameCiudad) VALUES(:codigoPostal,:nameCiudad)';

                $params['codigoPostal'] = $ciudad->getCodigoPostal();
                $params['nameCiudad'] = $ciudad->getNameCiudad();
                $params['idProvincia'] = $ciudad->getProvincia()->getId();
                
                return $con->executeNonQuery($query, $params);
            } catch (PDOException $e) {
                throw $e;
            }
        }
        
        function Delete($idObjeto){}
        function Update($objeto){}
        
        function mapping($value){
            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Ciudad((int)$p['codigoPostal'],$p['nameCiudad'],(int)$p['idProvincia']);
            },$value);
            return count($resp)>1 ? $resp : reset($resp);
        }

        public function GetByCodigoPostal($codigoPostal){
            try {
                $query = 'SELECT * FROM ciudades as c 
                            WHERE c.codigoPostal = :codigoPostal';
                $con = Connection::getInstance();
                $params['codigoPostal'] = $codigoPostal;
                $ciudad = $con->execute($query, $params);
                return (!empty($ciudad)) ? $this->mapping($ciudad) : false;
            } catch (PDOException $e) {
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }    
        }
    }

?>