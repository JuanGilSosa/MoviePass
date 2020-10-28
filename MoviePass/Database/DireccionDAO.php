<?php namespace Database; 

    use Models\Ubicacion\Direccion as Direccion;
    use Models\Ubicacion\Ciudad as Ciudad;
    use Models\Ubicacion\Provincia as Provincia;
    use Models\Ubicacion\Pais as Pais;

    class DireccionDAO implements IDAO{

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

                $query = 'INSERT INTO direcciones(calle,numero,piso) VALUES
                            (:calle,:numero,:piso)';

                $params['calle'] = $direccion->getNombre();
                $params['numero'] = $direccion->getNumero();
                $params['piso'] = $direccion->getPiso();
                
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
                    $p['id'],$p['calle'],$p['numero'],$p['piso']);
                return $dir;
            },$value);
            return $resp;
        }

        public function CreateDireccion($calle, $numero, $piso, $idCiudad, $codigoPostal, $idPais, $idProvincia){

            $paisDAO = new PaisDAO();
            $pais = $paisDAO->GetById($idPais);

            if($pais != false){
                $provinciaDAO = new ProvinciaDAO();
                $provincia = $provinciaDAO->GetById($idProvincia);
                
            
                if($provincia != false){
                    $ciudadDAO = new CiudadDAO();
                    $ciudad = $ciudadDAO->GetByCodigoPostal($idCiudad);

                    if($ciudad != false && $ciudad->getCodigoPostal() == $codigoPostal){
                        $direccion = new Direccion(0, $calle, $numero, $piso, $ciudad);

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
    }
?>