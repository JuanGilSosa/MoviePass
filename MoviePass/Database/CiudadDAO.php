<?php namespace Database;

    class CiudadDAO implements IDAO{

        public function __construct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS ciudades(
                                codigoPostal INT NOT NULL AUTO_INCREMENT,
                                nameCiudad VARCHAR(30),
                                CONSTRAINT pk_codigoPostal PRIMARY KEY(codigoPostal)
                            )';
                $con->executeNonQuery($query);
            }catch(PDOException $e){
                throw $e;
            }
        }

        function GetAll(){}
        function Add($objeto){
            try {
                $con = Connection::getInstance();
                $query = 'INSERT INTO ciudades(codigoPostal, nameCiudad) VALUES(:codigoPostal,:nameCiudad)';
            } catch (PDOException $e) {
                throw $e;
            }
        }
        function Delete($idObjeto){}
        function Update($objeto){}
        function mapping($value){}
    }

?>