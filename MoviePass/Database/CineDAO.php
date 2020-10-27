<?php namespace Database;

    use Models\Cine\Cine as Cine;

    class CineDAO implements IDAO{

        public function __construct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS 
                            cines(
                                idCine INT NOT NULL AUTO_INCREMENT, 
                                nombre varchar(30), 
                                email varchar(30), 
                                numeroDeContacto varchar(15), 
                                direccion varchar(30), 
                                active BOOLEAN, 
                                CONSTRAINT pk_idCine PRIMARY KEY(idCine)
                            );';

                $con->executeNonQuery($query);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function GetAll(){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT * FROM cines';
                $query1 = 'SELECT * FROM salas';
                $query2 = 'SELECT * FROM salaXcine';
                $array = $con->execute($query);
                return (!empty($array)) ? $this->mapping($array) : false;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function Add($cine){
            try{
                $con = Connection::getInstance();

                $query = 'INSERT INTO cines(nombre,email,numeroDeContacto,direccion,salas,active) VALUES
                            (:nombre,:email,:numeroDeContacto,:direccion,:salas,:active)';

                $params['nombre'] = $cine->getNombre();
                $params['email'] = $cine->getEmail();
                $params['numeroDeContacto'] = $cine->getNumeroDeContacto();
                $params['direccion'] = $cine->getDireccion();
                $params['salas'] = $cine->getSalas();
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
                    $a['id'],$a['nombre'],$a['email'],$a['numeroDeContacto'],$a['direccion'],$a['salas'],$a['active']
                );
                return $cine;
            },$value);
        }

        public function GetAllActive(){
            $activos = array();
            $this->GetAll();
            foreach($this->cines as $cine){ 
                if($cine->getActive()){
                    array_push($activos, $cine);
                }
            }
            return $activos;
        }

        public function getCineById ($cineId){
            $cines = $this->GetAll();
            $micine = null;
            foreach ($cines as $cine){
                if($cine->getId() == $cineId){
                    return $cine;
                }
            }
            return $micine;
        }

        public function FindCineByName ($name){
            $cines = $this->GetAll();
            $micine = null;
            foreach ($cines as $cine){
                if($cine->getNombre() == $name){
                    return $cine;
                }
            }
            return $micine;
        }

        public function FindCineByEmail ($email){
            $cines = $this->GetAll();
            $micine = null;
            foreach ($cines as $cine){
                if($cine->getEmail() == $email){
                    return $cine;
                }
            }
            return $micine;
        }

        public function FindCineByTelefono ($telefono){
            $cines = $this->GetAll();
            $micine = null;
            foreach ($cines as $cine){
                if($cine->getNumeroDeContacto() == $telefono){
                    return $cine;
                }
            }
            return $micine;
        }

        public function Delete($idCine){

        }
        public function Update($cine){
            $query = 'SELECT c.idCine FROM cines as c WHERE c.idCine = '.$cine->getId().';';
        }

 



    }
?>