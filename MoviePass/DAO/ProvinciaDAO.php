<?php
    namespace DAO;

    use DAO\IDAO as IDAO;
    use Models\Ubicacion\Provincia as Provincia;
    use Models\Ubicacion\Pais as Pais;

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

            foreach($this->provincias as $provincia){
                if ($provincia->getId() == $idProvincia)
                    return $provincia;
            }

            return false;
        }

        public function GetByName($nameProvincia)
        {
            $this->RetrieveData();

            foreach($this->provincias as $provincia){
                if ($provincia->getNameProvincia() == $nameProvincia)
                    return $provincia;
            }

            return false;            
        }


        public function GetProvinciasByIdPais($idPais)
        {
            $this->RetrieveData();
            $provincia = new Provincia();
            $provinciasDelPais = array();

            foreach ($this->provincias as $provincia)
            {
                $pais = $provincia->getPais();
                if($pais->getId() == $idPais)
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
                $pais = $provincia->getPais();
                $valuesArray["pais"] = $pais->getId();

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

                    $paisDAO = new PaisDAO();
                     
                    $pais = $paisDAO->GetById($valuesArray["pais"]);

                    $provincia->setPais($pais);

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