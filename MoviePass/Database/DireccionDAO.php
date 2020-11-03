<?php namespace Database; 

    use Models\Ubicacion\Direccion as Direccion;
    use Models\Ubicacion\Ciudad as Ciudad;
    use Models\Ubicacion\Provincia as Provincia;
    use Models\Ubicacion\Pais as Pais;

    class DireccionDAO implements IDAO{
/*
        public function __construct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS direcciones(
                                idDireccion INT NOT NULL AUTO_INCREMENT,
                                calle VARCHAR(30),
                                numero VARCHAR(5),
                                piso VARCHAR(3),
                                codigoPostal INT,
                                CONSTRAINT pk_idDireccion PRIMARY KEY(idDireccion),
                                CONSTRAINT fk_codigoPostal FOREIGN KEY(idCiudad) REFERENCES ciudades(idCiudad)
                            )';
                $con->executeNonQuery($query);
            }catch(PDOException $e){
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }
*/
        function GetAll(){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT * FROM direcciones';
                $direcciones = $con->execute($query);
                return $direcciones;
            }catch(PDOException $e){
                throw $e;
            }
        }
        function Add($direccion){
            try{
                $con = Connection::getInstance();

                $query = 'INSERT INTO direcciones(calle,numero,piso,codigoPostal) VALUES
                            (:calle,:numero,:piso,:codigoPostal)';

                $params['calle'] = $direccion->getCalle();
                $params['numero'] = $direccion->getNumero();
                $params['piso'] = $direccion->getPiso();
                $params['codigoPostal'] = $direccion->getCiudad()->getCodigoPostal();
                return $con->executeNonQuery($query, $params);
            }catch(PDOException $e){
                throw $e;
            }
        }
        function Delete($idObjeto){}
        function Update($objeto){}

        function mapping($value){
            $value = is_array($value) ? $value : [];
			$resp = array_map(function ($p){
                $dir = new Direccion(
                    $p['idDireccion'],$p['calle'],$p['numero'],$p['piso'],$p['codigoPostal']);
                return $dir;
            },$value);
            return count($resp)>1 ? $resp : reset($resp);
        }

        public function CreateDireccion($calle, $numero, $piso, $idCiudad, $codigoPostal, $idPais, $idProvincia){

            $paisDAO = new PaisDAO();
            $pais = $paisDAO->GetById($idPais);
            if($pais != false){
                $provinciaDAO = new ProvinciaDAO();
                $provincia = $provinciaDAO->GetById($idProvincia);
                if($provincia != false){
                    $provincia->setPais($pais); #haciendo esto, estamos sacando el id que tiene y le asignamos un objeto
                    $ciudadDAO = new CiudadDAO();
                    $ciudad = $ciudadDAO->GetByCodigoPostal($codigoPostal);
                    if($ciudad != false){
                        $ciudad->setProvincia($provincia); #mesmo - cambio el id por el objeto
                        $direccion = new Direccion($this->GetLastId(), $calle, $numero, $piso, $ciudad);
                        return $direccion;
                    }else{
                        return ("Codigo Postal equivocado, intente nuevamente.");
                    }
                }else{
                    return ("No encontramos la provincia en nuestra base de datos");
                }
            }else{
                return ("No encontramos el pais en nuestra base de datos");
            }
        }


        public function FindDireccion($objDireccion){

            $ciudad = $objDireccion->getCiudad();
            $ciudadDAO = new CiudadDAO();

            if($ciudadDAO->GetByCodigoPostal($ciudad->getCodigoPostal())){
                $provinciaDAO = new ProvinciaDAO();
                $provincia = $ciudad->getProvincia();
                
                if($provinciaDAO->GetByName($provincia->getNameProvincia())){

                    $pais = $provincia->getPais();
                    $paisDAO = new PaisDAO();

                    if($paisDAO->GetByName($pais->getNamePais())){

                        $direccionesPorCodigoPostal = $this->GetAllByCodigoPostal($ciudad->getCodigoPostal());

                        if($direccionesPorCodigoPostal != false){
                            foreach($direccionesPorCodigoPostal as $direccion){
                                if (
                                    ($direccion->getCalle() == $objDireccion->getCalle()) && 
                                    ($direccion->getNumero() == $objDireccion->getNumero()) &&
                                    ($direccion->getPiso() == $objDireccion->getPiso())
                                ){
                                    $codPostalSTR = $direccion->getCiudad()->getCodigoPostal();
                                    $direccion->getCiudad()->setCodigoPostal((int)$codPostalSTR);
                                    return $direccion;
                                }
                            }
                        }
                    }
                }

            }
            return false;
        }

        public function ChangeObjectById($direccion){
            $ciudadDAO = new CiudadDAO();
            $ciudad = $ciudadDAO->GetByCodigoPostal($direccion->getCiudad()->getCodigoPostal());
            
            if($ciudad != false){
                $direccion->setCiudad($ciudad);
                return $direccion;
            }
        }

        public function GetAllByCodigoPostal($codigoPostal){
            try {
                $query = 'SELECT * FROM direcciones WHERE codigoPostal = :codigoPostal';
                $params['codigoPostal'] = (int)$codigoPostal;
                $con = Connection::getInstance();
                $direcciones = $con->execute($query,$params);
                return (!empty($direcciones)) ? $this->mapping($direcciones) : false;
            } catch (PDOException $e) {
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }
        
        private function GetLastId():?int{
            try{
                $con = Connection::getInstance();
                #$query = 'SELECT @@identity AS id';
                $query = 'SELECT MAX(d.idDireccion) as lastID FROM direcciones as d;';
                $id = $con->execute($query);

                $ID = ($id[0]['lastID'] == null) ? 1 : (int)$id[0]['lastID'];
                
                return ($con->rowsOfTable('direcciones') > 0) ? $ID+1 : 1;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function GetDireccionById($idDireccion){
            try {
                $query = 'SELECT * FROM direcciones WHERE idDireccion = :idDireccion';
                $params['idDireccion'] = $idDireccion;
                $con = Connection::getInstance();
                $direccion = $con->execute($query,$params);
                return (!empty($direccion)) ? $this->mapping($direccion) : array();
            } catch (PDOException $e) {
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }


    
    }
?>