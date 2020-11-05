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
                $query = 'SELECT * FROM salas';
                $array = $con->execute($query);
                return (!empty($array)) ? $this->mapping($array) : false;
            }catch(PDOException $e){
                throw $e;
            }
        }

        public function GetSalaById($idSala){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT * FROM salas WHERE idSala='.$idSala . ";";
                $array = $con->execute($query);
                return (!empty($array)) ? $this->mapping($array) : false;
            }catch(PDOException $e){
                throw $e;
            }
        }
        
        
        public function mapping($value){
            $value = is_array($value) ? $value : [];
            $resp = array_map(function($a){
                $sala = new Sala(
                    $a['idSala'],$a['nombre'],$a['precio'],$a['capacidad'],$a['tipo']
                );
                return $sala;
            },$value);
            return count($resp)>1 ? $resp : $resp[0];
        }

        public function Delete($sala){

        }
        
        public function Update($idSala){

        }
        /* 
            Se usa este metodo para insertar en la tabla salaXcine ya que como agrego en la tabla salaxcine
            luego de insertar la sala en la base de datos este ultimo id seria el id de la sala que quiero usar
        */
        public function GetLastId(){
            try {
                $query = 'SELECT max(idSala) as maximo FROM salas;';
                $con = Connection::getInstance();
                $idSala = $con->execute($query);
                //var_dump($idSala);
                return (!empty($idSala)) ? (int)$idSala[0]['maximo'] : -1;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function ConvertToArray($salasPorCine){
            $salasArray = array();
            if(is_object($salasPorCine)):
                array_push($salasArray, $salasPorCine);
            else:
                return $salasPorCine;
            endif;
            return $salasArray;
        }

        ////TRATAR PARA SALAXCINE////
        public function GetSalasByCineId($idCine){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT s.* FROM salas as s JOIN salaxcine as sxc ON sxc.idSala = s.idSala AND sxc.idCine = :idCine';
                $params['idCine'] = $idCine;
                $cine = $con->execute($query, $params);
                return (!empty($cine)) ? $this->mapping($cine) : array();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function Add_SALAXCINE($idSala, $idCine){
            try{
                $con = Connection::getInstance();

                $query = 'INSERT INTO salaXcine(idSala, idCine) VALUES(:idSala, :idCine)';

                $params['idSala'] = $idSala;
                $params['idCine'] = $idCine;

                return $con->executeNonQuery($query, $params); 
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        /*
            Esto retornaria solo un arreglo con los id de sala y id de cine 
            Si es necesario que retorne un Objeto que tenga como atrib cine & sala, hay que hacer el mapeo y hacer consultas
        */
        public function GetAll_SALAXCINE(){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT * FROM salaXcine';
                $res = $con->execute($query);
                return (!empty($res)) ? $res : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        public function GetRoom_SALAXFUNCION($idFunction){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT s.* 
                            FROM salaxfuncion as sxf 
                            INNER JOIN salas as s 
                                ON sxf.idSala = s.idSala 
                                    AND s.idSala = :idFuncion;';
                $params['idFuncion'] = $idFunction;
                $rooms = $con->execute($query, $params);
                return (!emtpy($rooms)) ? $this->mapping($rooms) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>