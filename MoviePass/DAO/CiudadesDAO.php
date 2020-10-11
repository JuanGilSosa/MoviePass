<?php
    namespace DAO;

    use DAO\IDAO as IDAO;
    use Models\Ubicacion\Ciudad as Ciudad;

    class CiudadesDAO implements IDAO
    {
        private $ciudades = array();
        private $fileName = 'Data/ciudades.json';

        public function Add($localidad)
        {
            $this->RetrieveData();
            
            array_push($this->ciudades, $ciudad);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->ciudades;
        }

        public function GetByCodigoPostal($codigoPostal)
        {
            $this->RetrieveData();


            foreach($this->ciudades as $ciudad){
                if ($ciudad->getCodigoPostal() == $codigoPostal)
                    return $ciudad; 
            }

        }

        public function Delete($idCiudad){

        }

        public function Update($ciudad){
            
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->ciudades as $ciudad)
            {                
                $valuesArray["ciudad"] = $ciudad->getCiudad();
                $valuesArray["codigoPostal"] = $ciudad->getCodigoPostal();
                $valuesArray["idProvincia"] = $ciudad->getIdProvincia();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->ciudades = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $ciudad = new Ciudad();
                    $ciudad->setCiudad($valuesArray["ciudad"]);
                    $ciudad->setCodigoPostal($valuesArray["codigoPostal"]);
                    $ciudad->setIdProvincia($valuesArray["provincia"]);

                    array_push($this->ciudades, $ciudad);
                }
            }
        }



        private function GetNextId()
        {
            $id = 0;

            foreach($this->ciudades as $ciudad)
            {
                $id = ($ciudad->getId() > $id) ? $ciudad->getId() : $id;
            }

            return $id + 1;
        }



    }
?>