<?php
    namespace DAO;

    use DAO\IDAO as IDAO;
    use DAO\PaisDAO as PaisDAO;
    use DAO\ProvinciaDAO as ProvinciaDAO;
    use DAO\CiudadDAO as CiudadDAO;
    use Models\Ubicacion\Direccion as Direccion;
    use Models\Ubicacion\Ciudad as Ciudad;
    use Models\Ubicacion\Provincia as Provincia;
    use Models\Ubicacion\Pais as Pais;

    class DireccionDAO implements IDAO{

        private $direcciones = array();
        private $fileName = 'Data/direcciones.json';

        public function Add($direccion){
            $this->RetrieveData();
            
            $direccion->setId($this->GetNextId());
            
            array_push($this->direcciones, $direccion);

            $this->SaveData();
        }

        public function CreateDireccion($calle, $numero, $piso, $idCiudad, $codigoPostal, $pais, $provincia){

            $paisDAO = new PaisDAO();
            $pais = $paisDAO->GetById($pais);

            if($pais != false){
                $provinciaDAO = new ProvinciaDAO();
                $provincia = $provinciaDAO->GetById($provincia);
                
            
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

        public function GetAll(){
            $this->RetrieveData();

            return $this->direcciones;
        }

        public function GetDireccionById ($idDireccion){
            $this->RetrieveData();
            $idDirLocal = \strval($idDireccion);
            foreach($this->direcciones as $direccion){
                /*                
                if(!is_int($idDireccion)){
                    $idDireccion = $idDireccion->getId();
                }
                */
                if ($direccion->getId() == $idDireccion)
                    return $direccion;
            }
            return false;
        }

        public function GetAllByCodigoPostal($codigoPostal){

            $this->RetrieveData();
            $direccionesPorCodigoPostal = array();

            foreach($this->direcciones as $direccion){
                $ciudad = $direccion->getCiudad();
                if ($ciudad->getCodigoPostal() == $codigoPostal)
                    array_push($direccionesPorCodigoPostal, $direccion);
            }

            return $direccionesPorCodigoPostal;
        }

        public function Delete($idUser){

        }

        public function Update($user){
            
        }

        private function SaveData(){
            $arrayToEncode = array();

            foreach($this->direcciones as $direccion)
            {
                $valuesArray["id"] = $direccion->getId();
                $valuesArray["calle"] = $direccion->getCalle();
                $valuesArray["numero"] = $direccion->getNumero();
                $valuesArray["piso"] = $direccion->getPiso();
                
                $ciudad = $direccion->getCiudad();
                $valuesArray["ciudad"] = $ciudad->getCodigoPostal();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }
        
        private function RetrieveData(){

            $this->direcciones = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $direccion = new Direccion();
                    $direccion->setId($valuesArray["id"]);
                    $direccion->setCalle($valuesArray["calle"]);
                    $direccion->setNumero($valuesArray["numero"]);
                    $direccion->setPiso($valuesArray["piso"]);
                    $direccion->setCiudad($valuesArray["ciudad"]);

                    $ciudadDAO = new CiudadDAO();
                    $ciudad= $ciudadDAO->GetByCodigoPostal($direccion->getCiudad());

                    $direccion->setCiudad($ciudad);
                    
                    array_push($this->direcciones, $direccion);
                }
            }
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->direcciones as $direccion)
            {
                $id = ($direccion->getId() > $id) ? $direccion->getId() : $id;
            }

            return $id + 1;
        }

        public function FindDireccion($direccionIngresada)
        {
            $ciudad = $direccionIngresada->getCiudad();
            $ciudadDAO = new CiudadDAO();

            if($ciudadDAO->GetByCodigoPostal($ciudad->getCodigoPostal())) {
                $provincia = $ciudad->getProvincia();
                $provinciaDAO = new ProvinciaDAO();

                if($provinciaDAO->GetByName($provincia->getNameProvincia())){
                    $pais = $provincia->getPais();
                    $paisDAO = new PaisDAO();

                    if($paisDAO->GetByName($pais->getNamePais())){

                        $direccionesPorCodigoPostal = $this->GetAllByCodigoPostal($ciudad->getCodigoPostal());

                        foreach($direccionesPorCodigoPostal as $direccion)
                        {
                            if ($direccion->getCalle() == $direccionIngresada->getCalle() && 
                            $direccion->getNumero() == $direccionIngresada->getNumero() &&
                            $direccion->getPiso() == $direccionIngresada->getPiso())
                            {
                                return $direccion;
                            }
                        }
                    }

                }

            }

            return false;
        }

    }
    
?>