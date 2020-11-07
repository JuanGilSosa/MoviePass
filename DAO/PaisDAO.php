<?php
    namespace DAO;

    use DAO\IDAO as IDAO;
    use Models\Ubicacion\Pais as Pais;

    class PaisDAO implements IDAO
    {
        private $paises = array();
        private $fileName = 'Data/paises.json';

        public function Add($pais)
        {
            $this->RetrieveData();

            $pais->setId($this->GetNextId());
            
            array_push($this->paises, $pais);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->paises;
        }

        public function GetById($idPais)
        {
            $this->RetrieveData();
            foreach($this->paises as $pais){
                if ($pais->getId() == $idPais)
                    return $pais;
            }

            return false;            
        }

        public function GetByName($namePais)
        {
            $this->RetrieveData();

            foreach($this->paises as $pais){
                if ($pais->getNamePais() == $namePais)
                    return $pais;
            }

            return false;            
        }

        public function Delete($idPais){

        }

        public function Update($pais){
            
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->paises as $pais)
            {                
                $valuesArray["id"] = $pais->getId();
                $valuesArray["namePais"] = $pais->getNamePais();

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
                    $pais = new Pais();
                    $pais->setId($valuesArray["id"]);
                    $pais->setNamePais($valuesArray["namePais"]);

                    array_push($this->paises, $pais);
                }
                
            }
        }



        private function GetNextId()
        {
            $id = 0;

            foreach($this->paises as $pais)
            {
                $id = ($pais->getId() > $id) ? $pais->getId() : $id;
            }

            return $id + 1;
        }

    }
?>