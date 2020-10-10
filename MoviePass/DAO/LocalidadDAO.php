<?php
    namespace DAO;

    use DAO\IDireccionDao as IDireccionDao;
    use Models\Ubicacion\Localidad as Localidad;
    use Models\Ubicacion\Pais as Pais;

    class LocalidadDAO implements ILocalidadDAO
    {
        private $localidades = array();
        private $fileName = 'Data/localidades.json';

        public function Add(Localidad $localidad)
        {
            $this->RetrieveData();
            
            array_push($this->localidades, $localidad);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->localidades;
        }

        public function GetByCodigoPostal($codigoPostal)
        {
            $this->RetrieveData();

            $ciudad = new Localidad();

            foreach($this->localidades as $localidad){
                if ($localidad->getCodigoPostal() == $codigoPostal)
                    $ciudad = $localidad; 
            }

            return $ciudad;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->localidades as $localidad)
            {                
                $valuesArray["localidad"] = $localidad->getLocalidad();
                $valuesArray["codigoPostal"] = $localidad->getCodigoPostal();
                $valuesArray["provincia"] = $localidad->getProvincia();
                $valuesArray["idPais"] = $localidad->getIdPais();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->studentList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $localidad = new Localidad();
                    $localidad->setLocalidad($valuesArray["localidad"]);
                    $localidad->setCodigoPostal($valuesArray["codigoPostal"]);
                    $localidad->setProvincia($valuesArray["provincia"]);
                    $localidad->setIdPais($valuesArray["idPais"]);

                    array_push($this->localidades, $localidad);
                }
            }
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->localidades as $direccion)
            {
                $id = ($direccion->getId() > $id) ? $direccion->getId() : $id;
            }

            return $id + 1;
        }



    }
?>