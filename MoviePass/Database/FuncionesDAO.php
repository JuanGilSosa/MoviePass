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
    }
?>