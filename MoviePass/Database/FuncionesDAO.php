<?php namespace Database;

    use Models\Pelicula\Funcion as Funcion;

    class FuncionesDAO implements IDAO{
         
        
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
                $params['idPelicula'] = $funcion->getPelicula()->getId();
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

        public function mapping($value){
            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Funcion($p['idFuncion'], $p['horaInicio'], $p['horaFin'], null, $p['idPelicula'], $p['active']);
            }, $value);
        }
    }
?>