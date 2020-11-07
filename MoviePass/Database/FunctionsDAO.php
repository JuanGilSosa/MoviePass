<?php namespace Database;

    use Models\Pelicula\Funcion as Funcion;
    use PDOException as PDOException;

    class FunctionsDAO implements IDAO{
         
        
        /*
        public function __costruct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS funciones(
                                idFuncion INT NOT NULL AUTO_INCREMENT,
                                horaInicio VARCHAR(30),
                                horaFin VARCHAR(30),
                                idPelicula INT,
                                CONSTRAINT pk_idFuncion PRIMARY KEY(idFuncion),
                                CONSTRAINT fk_idPelicula FOREIGN KEY(idPelicula) REFERENCES peliculas(idPelicula)                    
                            )';
                $con->executeNonQuery($query);
            }catch(PDOException $e){
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }*/

        public function GetAll(){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT * FROM funciones';
                $funciones = $con->execute($query); 
                return (!empty($funciones)) ? $this->mapping($funciones) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function GetAllActive(){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT * FROM funciones WHERE active = :active';
                $params['active'] = 1;
                $funciones = $con->execute($query, $params); 
                return (!empty($funciones)) ? $this->mapping($funciones) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function Add($funcion){
            try {
                $con = Connection::getInstance();
                $query = 'INSERT INTO funciones(horaInicio, horaFin, idPelicula, active) VALUES(:horaInicio, :horaFin, :idPelicula, :active)';
                $params['horaInicio'] = $funcion->getHoraInicio();
                $params['horaFin'] = $funcion->getHoraFin();
                $params['idPelicula'] = $funcion->getMovie()->getId();
                $params['active'] = 1;
                return $con->executeNonQuery($query, $params);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function Delete($funcionId){

        }

        public function Update($funcion){

        }

        public function GetLastId(){
            try {
                $query = 'SELECT max(idFuncion) as maximo FROM funciones;';
                $con = Connection::getInstance();
                $idFuncion = $con->execute($query);
                //var_dump($idSala);
                return (!empty($idFuncion)) ? (int)$idFuncion[0]['maximo'] : -1;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function Add_FUNCIONESXSALA($idSala, $idFuncion){
            try{
                $con = Connection::getInstance();

                $query = 'INSERT INTO salaxfuncion(idSala, idFuncion) VALUES(:idSala, :idFuncion)';

                $params['idSala'] = $idSala;
                $params['idFuncion'] = $idFuncion;

                return $con->executeNonQuery($query, $params); 
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }


        public function mapping($value){
            $value = is_array($value) ? $value : [];
            $ans = array_map(function($p){
                $func = new Funcion($p['idFuncion'], $p['idPelicula'], $p['horaInicio'], $p['horaFin'], 0);
                $func->setActive($p['active']);
                return $func;
            }, $value);
            return (count($ans)>1) ? $ans : $ans[0];
        }
/*
        public function GetFunction_CARTELERAXFUNCION($idBillboard){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT f.* 
                            FROM carteleraxfuncion as cxf 
                            INNER JOIN funciones as f 
                                ON cxf.idFuncion = f.idFuncion 
                                    AND f.idFuncion = :idFuncion 
                                    AND f.active = 1;
                            ';
                $params['idFuncion'] = $idBillboard;
                $functions = $con->execute($query, $params);
                return (!emtpy($functions)) ? $this->mapping($functions) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
*/
        public function GetFunction_SALAXFUNCION($idRoom){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT f.* 
                            FROM salaxfuncion as sxf 
                            INNER JOIN funciones as f 
                                ON sxf.idFuncion = f.idFuncion 
                                    AND sxf.idSala = :idSala 
                            ';
                $params['idSala'] = $idRoom;
                $functions = $con->execute($query, $params);
                return (!empty($functions)) ? $this->mapping($functions) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        
    }
?>