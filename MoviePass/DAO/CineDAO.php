<?php
    namespace DAO;

    use DAO\ICineDAO as ICineDAO;
    use Models\Cine\Cine as Cine;

    class CineDAO implements ICineDAO
    {
        private $cines = array();
        private $fileName = 'Data/cines.json';

        public function Add(Cine $cine)
        {
            $this->RetrieveData();

            $cine->setId($this->GetNextId());
            
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
                $valuesArray["email"] = $cine->getEmail();
                $valuesArray["numeroDeContacto"] = $cine->getNumeroDeContacto();
                //$valuesArray["direccion"] = $direccion;
                //$valuesArray["localidad"] = $localidad;

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
                    $cine = new Cine();
                    $cine->setId($valuesArray["id"]);
                    $cine->setNombre($valuesArray["nombre"]);
                    $cine->setEmail($valuesArray["email"]);
                    $cine->setNumeroDeContacto($valuesArray["numeroDeContacto"]);
                    //$cine->setDireccion($valuesArray["direccion"]);
                    //$cine->setLocalidad($valuesArray["localidad"]);

                    array_push($this->cines, $cine);
                }
            }
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->cines as $cine)
            {
                $id = ($cine->getId() > $id) ? $cine->getId() : $id;
            }

            return $id + 1;
        }


    }
?>