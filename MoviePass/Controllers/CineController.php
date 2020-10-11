<?php
    namespace Controllers;

    use DAO\CineDAO as CineDAO;
    use DAO\CiudadDAO as CiudadDAO;
    use DAO\DireccionDAO as DireccionDAO;
    use Models\Cine\Cine as Cine;
    use Models\Ubicacion\Direccion as Direccion;
    use Models\Ubicacion\Ciudad as Ciudad;
    //agregar Provincias
    //agregar Pais

    class CineController
    {
        private $cineDAO;
        private $ciudadDAO;
        private $direccionDAO;

        public function __construct()
        {
            $this->cineDAO = new CineDAO();
            $this->ciudadDAO = new CiudadDAO();
            $this->direccionDAO = new DireccionDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."addCine.php");
        }

        public function ShowListView()
        {
            $cines = $this->cineDAO->GetAll();
            $direcciones = $this->direccionDAO->GetAll();
            $ciudades = $this->ciudadDAO->GetAll();

            require_once(VIEWS_PATH."cinesList.php");
        }

        public function Add($nombre, $email, $numeroDeContacto, $calle, $numero, $piso, $departamento, $ciudad, $codigoPostal, $idProvincia, $pais)
        {
            $cine = new Cine($nombre, $email, $numeroDeContacto);
            $direccion = new Direccion($calle, $numero, $piso, $departamento);
            $ciudad = new Ciudad($ciudad, $codigoPostal, $idProvincia);

            //REVISAR ESTO, HAY QUE AGREGAR PAIS Y PROVINCIA

            /* 
                $cine->setDireccionId($direccionId);
                $cine->setLocalidadId($codigoPostal);
            */

            $this->cineDAO->Add($cine);
            $this->ciudadDAO->Add($ciudad);
            $this->direccionDAO->Add($direccion);

            //ACA SE GUARDARIA EN TABLA CINESxLOCALIDADxDIRECCION?

            $this->ShowAddView();
        }

    }
?>