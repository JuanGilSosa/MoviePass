<?php
    namespace DAO;

    use DAO\ICineDAO as ICineDAO;
    use Cine\Cine as Cine;

    class CineDAO implements ICineDAO
    {
        private $cines = array();
        private $fileName = 'Data/cines.json';

        public function Add(Cine $cine)
        {
            $this->RetrieveData();
            
            array_push($this->cines, $cine);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->cines;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cines as $cine)
            {
                $valuesArray["id"] = $cine->getId();
                $valuesArray["nombre"] = $cine->getNombre();
                $valuesArray["direccion"] = $cine->getDirecciones();
                $valuesArray["localidad"] = $cine->getLocalidades();

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
                $jsonContent = file_get_contents('Data/students.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cine = new Cine();
                    $cine->setId($valuesArray["id"]);
                    $cine->setNombre($valuesArray["nombre"]);
                    $cine->setDireccion($valuesArray["direccion"]);
                    $cine->setLocalidad($valuesArray["localidad"]);

                    array_push($this->cines, $cine);
                }
            }
        }
    }
?>