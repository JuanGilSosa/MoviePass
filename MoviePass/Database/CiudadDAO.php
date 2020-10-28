<?php namespace Database;

    use Models\Ubicacion\Ciudad as Ciudad;

    class CiudadDAO implements IDAO{

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
                $ciudad = new Ciudad($p['codigoPostal'],$p['nameCiudad'],$p['provincia']);
                return $ciudad;
            },$value);
            return $resp;
        }

        public function GetByCodigoPostal($codigoPostal){
            $ciudades = $this->GetAll();
            foreach($ciudades as $ciudad){                
                if ($ciudad->getCodigoPostal() == $codigoPostal){
                    return $ciudad; 
                }
            }
            return false;
        }
    }

?>