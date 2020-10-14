<?php
    namespace DAO;

    use DAO\IDAO as IDAO;
    use Models\Ubicacion\Provincia as Provincia;

    class ProvinciaDAO implements IDAO
    {
        private $provincias = array();
        private $fileName = 'Data/provincias.json';

        public function Add($provincia)
        {
            $this->RetrieveData();

            $provincia->setId($this->GetNextId());
            
            array_push($this->provincias, $provincia);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->provincias;
        }

        public function GetById($idProvincia)
        {
            $this->RetrieveData();

            $provincia = new Provincia();

            foreach($this->provincias as $provincia){
                if ($provincia->getId() == $idProvincia)
                return $provincia;
            }
        }

        public function GetProvinciasByIdPais ($idPais)
        {
            $this->RetrieveData();
            $provincia = new Provincia();
            $provinciasDelPais = array();

            foreach ($this->provincias as $provincia)
            {
                if($provincia->getIdPais() == $idPais)
                {
                    array_push ($provinciasDelPais, $provincia);
                }
            }
            return $provinciasDelPais;
        }

        public function Delete($idProvincia){

        }

        public function Update($provincia){
            
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->provincias as $provincia)
            {                
                $valuesArray["id"] = $provincia->getId();
                $valuesArray["nameProvincia"] = $provincia->getNameProvincia();
                $valuesArray["idPais"] = $provincia->getIdPais();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->provincias = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $provincia = new Provincia();
                    $provincia->setId($valuesArray["id"]);
                    $provincia->setNameProvincia($valuesArray["nameProvincia"]);
                    $provincia->setIdPais($valuesArray["idPais"]);

                    array_push($this->provincias, $provincia);
                }
                
            }
        }



        private function GetNextId()
        {
            $id = 0;

            foreach($this->provincias as $provincia)
            {
                $id = ($provincia->getId() > $id) ? $provincia->getId() : $id;
            }

            return $id + 1;
        }



    }
?>