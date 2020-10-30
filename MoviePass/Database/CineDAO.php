<?php namespace Database;

    use Models\Cine\Cine as Cine;

    class CineDAO implements IDAO{
/*
        public function __construct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS 
                            cines(
                                idCine INT NOT NULL AUTO_INCREMENT, 
                                nombre VARCHAR(30), 
                                email VARCHAR(30), 
                                numeroDeContacto VARCHAR(15), 
                                idDireccion INT NOT NULL, 
                                active BOOLEAN, 
                                CONSTRAINT pk_idCine PRIMARY KEY(idCine),
                                CONSTRAINT fk_idDirecionn FOREIGN KEY(idDireccion) REFERENCES direccion(idDireccion)
                            );';

                $con->executeNonQuery($query);
            }catch(PDOException $e){
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }
*/
        public function GetAll(){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT * FROM cines';
                $array = $con->execute($query);
                return (!empty($array)) ? $this->mapping($array) : false;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        
        public function Add($cine){
            try{
                $con = Connection::getInstance();

                $query = 'INSERT INTO cines(nombre,email,numeroDeContacto,idDireccion,active) VALUES
                            (:nombre,:email,:numeroDeContacto,:idDireccion,:active)';

                $params['nombre'] = $cine->getNombre();
                $params['email'] = $cine->getEmail();
                $params['numeroDeContacto'] = $cine->getNumeroDeContacto();
                $params['idDireccion'] = $cine->getDireccion()->getId();
                #$params['salas'] = $cine->getSalas();
                $params['active'] = $cine->getActive();

                return $con->executeNonQuery($query, $params);
            }catch(PDOException $e){
                throw $e;
            }
        }

        public function mapping($value){
            $value = is_array($value) ? $value : [];
            $resp = array_map(function($a){
                $cine = new Cine(
                    $a['idCine'],$a['nombre'],$a['email'],$a['numeroDeContacto'],$a['idDireccion'],array(),$a['active']
                );
                return $cine;
            },$value);
            return count($resp)>1 ? $resp : reset($resp);
        }

        public function GetAllActive(){
            try {
                $query = 'SELECT * FROM cines WHERE active = :active';
                $con = Connection::getInstance();
                $params['active'] = 1;
                $allActive = $con->execute($query,$params); 
                return (!empty($allActive)) ? $this->mapping($allActive) : array();
            } catch (PDOException $e) {
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }       
        }

        public function GetCineById ($cineId){
            try {
                $query = 'SELECT * FROM cines WHERE cineId = :cineId';
                $con = Connection::getInstance();
                $params['cineId'] = $cineId;
                
                $cines = $con->execute($query,$params);
                return (!empty($cines)) ? $this->mapping($cines) : false;
            } catch (PDOException $e) {
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }       
        }

        public function FindCineByName ($name){
            try{
                $query = 'SELECT * FROM cines WHERE nombre = :nombre';
                $params['nombre'] = $name;
                $con = Connection::getInstance();
                $cines = $con->execute($query,$params);
                return (!empty($cines)) ? $this->mapping($cines) : false;
            }catch(PDOException $e){    
                echo 'Excepcion en : '.$e->getMessage();
            }
        }

        public function FindCineByEmail ($email){
            try{
                $query = 'SELECT * FROM cines WHERE email = :email';
                $params['email'] = $email;
                $con = Connection::getInstance();
                $cines = $con->execute($query,$params);
                return (!empty($cines)) ? $this->mapping($cines) : false;
            }catch(PDOException $e){    
                echo 'Excepcion en : '.$e->getMessage();
            }
        }

        public function FindCineByTelefono ($telefono){
            try{
                $query = 'SELECT * FROM cines WHERE numeroDeContacto = :numeroDeContacto';
                $params['numeroDeContacto'] = $telefono;
                $con = Connection::getInstance();
                $cines = $con->execute($query,$params);
                return (!empty($cines)) ? $this->mapping($cines) : false;
            }catch(PDOException $e){    
                echo 'Excepcion en : '.$e->getMessage();
            }
        }

        public function Delete($idCine){

        }
        public function Update($cine){
            $query = 'SELECT c.idCine FROM cines as c WHERE c.idCine = '.$cine->getId().';';
        }

 



    }
?>