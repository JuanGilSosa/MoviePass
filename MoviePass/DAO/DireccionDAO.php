<?php
    namespace DAO;

    use DAO\IDAO as IDAO;
    use Models\Ubicacion\Direccion as Direccion;

    class DireccionDAO implements IDAO
    {
        private $direcciones = array();
        private $fileName = 'Data/direcciones.json';

        public function Add($direccion)
        {
            $this->RetrieveData();

            $direccion->setId($this->GetNextId());
            
            array_push($this->direcciones, $direccion);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->direcciones;
        }

        public function GetByCodigoPostal($codigoPostal)
        {
            $this->RetrieveData();

            $home = new Direccion();

            foreach($this->direcciones as $direccion){
                if ($direccion->getCodigoPostal() == $codigoPostal)
                    $home = $direccion; 
            }

            return $home;
        }

        public function Delete($idUser){

        }

        public function Update($user){
            
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->direcciones as $direccion)
            {
                $valuesArray["id"] = $direccion->getId();
                $valuesArray["calle"] = $direccion->getCalle();
                $valuesArray["numero"] = $direccion->getNumero();
                $valuesArray["piso"] = $direccion->getPiso();
                $valuesArray["departamento"] = $direccion->getDepartamento();
                $valuesArray["idCiudad"] = $direccion->getIdCiudad();

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
                    $direccion = new Direccion();
                    $direccion->setId($valuesArray["id"]);
                    $direccion->setCalle($valuesArray["calle"]);
                    $direccion->setNumero($valuesArray["numero"]);
                    $direccion->setPiso($valuesArray["piso"]);
                    $direccion->setDepartamento($valuesArray["departamento"]);
                    $direccion->setCodigoPostal($valuesArray["codigoPostal"]);

                    array_push($this->direcciones, $direccion);
                }
            }
        }

        public function GetById ($idDireccion)
        {
            $this->RetrieveData();

            $home = new Direccion();
            

            foreach($this->direcciones as $direccion){
                if ($direccion->getId() == $idDireccion)
                $home = $direccion;
            }
            return $home;
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



    }
?>