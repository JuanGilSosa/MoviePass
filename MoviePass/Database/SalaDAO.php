<?php namespace Database; 

    use Database\Connection as Connection;
    use Models\Cine\Sala as Sala;
    use PDOException as PDOException;

    class SalaDAO implements IDAO{
/*
        public function __construct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS 
                            salas(
                                idSala INT NOT NULL AUTO_INCREMENT, 
                                nombre VARCHAR(30), 
                                precio VARCHAR(5), 
                                capacidad VARCHAR(3), 
                                tipo VARCHAR(5),
                                CONSTRAINT pk_idSala PRIMARY KEY(idSala),
                            );';
                $con->executeNonQuery($query);
            }catch(PDOException $e){
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }
*/
        public function Add($sala){
            try{
                $con = Connection::getInstance();

                $query = 'INSERT INTO salas(nombre,precio,capacidad,tipo) VALUES
                            (:nombre,:precio,:capacidad,:tipo)';

                $params['nombre'] = $sala->getNombre();
                $params['precio'] = $sala->getPrecio();
                $params['capacidad'] = $sala->getCapacidad();
                $params['tipo'] = $sala->getTipo();

                return $con->executeNonQuery($query, $params);
            }catch(PDOException $e){
                throw $e;
            }
        }

        public function GetAll(){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT * FROM sala';
                $array = $con->execute($query);
                return (!empty($array)) ? $this->mapping($array) : false;
            }catch(PDOException $e){
                throw $e;
            }
        }
        
        public function mapping($value){
            $value = \is_array($value) ? $value : [];
            $resp = array_map(function($a){
                $sala = new Sala(
                    $a['id'],$a['nombre'],$a['precio'],$a['capacidad'],$a['tipo']
                );
                return $sala;
            },$value);
            return $resp;
        }

        public function Delete($sala){

        }
        
        public function Update($idSala){

        }
    }
?>