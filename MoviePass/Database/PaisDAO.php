<?php namespace Database; 

    use Models\Ubicacion\Pais as Pais;

    class PaisDAO implements IDAO{
/*
        public function __construct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS paises(idPais INT NOT NULL AUTO_INCREMENT, namePais VARCHAR(30), CONSTRAINT pk_idPais PRIMARY KEY(idPais));';
                $con->executeNonQuery($query);
            }catch(PDOException $e){
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }
*/
        function GetAll(){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT * FROM paises';
                $paises = $con->execute($query);
                return (!empty($paises)) ? $this->mapping($paises) : false;
            }catch(PDOException $e){
                throw $e;
            }
        }

        function Add($pais){
            try{
                $con = Connection::getInstance();

                $query = 'INSERT INTO paises(namePais) VALUES
                            (:namePais)';

                $params['namePais'] = $cine->getNombre();
                
                return $con->executeNonQuery($query, $params);
            }catch(PDOException $e){
                throw $e;
            }
        }

        function Delete($idObjeto){}
        function Update($objeto){}

        function mapping($value){
            $value = is_array($value) ? $value : [];
            $return = array_map(function($p){
                return new Pais($p['idPais'], $p['namePais']);
            },$value);
            return count($return)>1 ? $return : $return[0];
        }

        public function GetById($idPais){
            try {
                $query = 'SELECT * FROM paises WHERE idPais = :idPais';
                $con = Connection::getInstance();
                $params['idPais'] = $idPais;
                
                $pais = $con->execute($query,$params);
                return (!empty($pais)) ? $this->mapping($pais) : false;
            } catch (PDOException $e) {
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }           
        }

        public function GetByName($namePais){
            try {
                $query = 'SELECT * FROM paises WHERE namePais = :namePais';
                $params['namePais'] = $namePais;
                $con = Connection::getInstance();
                $pais = $con->execute($query, $params);
                return (!empty($pais)) ? $this->mapping($pais) : false;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

    }

?>