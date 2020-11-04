<?php namespace Database;
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

        }

        public function Add($cine){

        }

        public function Delete($cineId){

        }

        public function Update($cine){

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

                $query = 'INSERT INTO salaxfunciones(idSala, idFuncion) VALUES(:idSala, :idFuncion)';

                $params['idSala'] = $idSala;
                $params['idFuncion'] = $idFuncion;

                return $con->executeNonQuery($query, $params); 
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }


        public function mapping($value){

        }
    }
?>