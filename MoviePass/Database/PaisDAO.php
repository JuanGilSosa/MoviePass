<?php namespace Database; 

    use Models\Ubicacion\Pais as Pais;

    class PaisDAO implements IDAO{

        public function __construct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS 
                            paises(
                                idPais INT NOT NULL AUTO_INCREMENT, 
                                namePais VARCHAR(30),  
                                CONSTRAINT pk_idPais PRIMARY KEY(idPais),
                            );';
                $con->executeNonQuery($query);
            }catch(PDOException $e){
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }

        function GetAll(){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT * FROM paises';
                $paises = $con->execute($query);
                return $paises;
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
        }

        public function GetById($idPais){
            $paises = $this->GetAll();
            foreach($paises as $pais){
                if ($pais->getId() == $idPais){
                    return $pais;
                }
            }
            return false;            
        }

    }

?>