<?php
    namespace DAO;

    use DAO\IDAO as IDAO;
    use Models\Cine\Cine as Cine;

    class CineDAO implements IDAO
    {
        private $cines = array();
        private $fileName = 'Data/cines.json';

        public function Add($cine)
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

        public function GetAllActive()
        {
            $activos = array();
            $this->RetrieveData();
            
            foreach($this->cines as $cine)
            { 
                if($cine->getActive())
                {
                    array_push($activos, $cine);
                }
            }
            return $activos;
        }

        public function Delete($idCine){

            // buscar el cine por id. Y llevar el boolean a false y grabar.
            $cinesNuevos = array();
            $this->RetrieveData();

            foreach ($this->cines as $cine)
            {
                if($cine->getId() == $idCine)
                {
                    $cine->setActive(false);
                }
                array_push($cinesNuevos,$cine);
            }
        
            $this->cines = $cinesNuevos;
            $this->SaveData();           
        }

        public function Update($cineEditado){
            
            // buscar cine, actualizar array y grabar.
            echo "Cine Editado: " . $cineEditado->getId();
            $cinesNuevos = array();
            $this->RetrieveData();
            
            foreach ($this->cines as $cine)
            {
                if($cine->getId() == $cineEditado->getId())
                {
                    $cine = $cineEditado;
                }
                array_push($cinesNuevos,$cine);
            }
            $this->cines = $cinesNuevos;
            $this->SaveData();           
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
                $direccion = $cine->getDireccion();
                
                /*
                echo "<br>";
                var_dump($direccion);
                echo "<br>";
                */
                if(!is_string($direccion))  //SI SACO ESTO QUEDA UNA DIRECCION COMO STRING Y TIRA BRONCA POR ESTAR TRATANDO DE APLICAR UN METODO DE Direccion SOBRE UN STRING
                    $valuesArray["direccion"] = $direccion->getId();
                
                    $valuesArray["active"] = $cine->getActive();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->cines = array();

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
                    $cine->setDireccion($valuesArray["direccion"]);

                    $direccionDAO = new DireccionDAO();
                    $direccion = $direccionDAO->GetDireccionById($valuesArray["direccion"]);

                    $cine->setDireccion($direccion);

                    $cine->setActive($valuesArray["active"]);
                    
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


        public function getCineById ($cineId)
        {
            $cines = $this->GetAll();
            $micine = null;

            foreach ($cines as $cine)
            {
                if($cine->getId() == $cineId)
                {
                    return $cine;
                }
            }

            return $micine;
        }

        public function FindCineByName ($name)
        {
            $cines = $this->GetAll();
            $micine = null;

            foreach ($cines as $cine)
            {
                if($cine->getNombre() == $name)
                {
                    return $cine;
                }
            }

            return $micine;
        }

        public function FindCineByEmail ($email)
        {
            $cines = $this->GetAll();
            $micine = null;

            foreach ($cines as $cine)
            {
                if($cine->getEmail() == $email)
                {
                    return $cine;
                }
            }

            return $micine;
        }

        public function FindCineByTelefono ($telefono)
        {
            $cines = $this->GetAll();
            $micine = null;

            foreach ($cines as $cine)
            {
                if($cine->getNumeroDeContacto() == $telefono)
                {
                    return $cine;
                }
            }

            return $micine;
        }

    }


?>