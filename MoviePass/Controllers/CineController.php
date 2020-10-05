<?php
    namespace Controllers;

    use DAO\CineDAO as CineDAO;
    use DAO\LocalidadDAO as LocalidadDAO;
    use DAO\DireccionDAO as DireccionDAO;
    use Models\Cine\Cine as Cine;
    use Models\Ubicacion\Direccion as Direccion;
    use Models\Ubicacion\Localidad as Localidad;

    class CineController
    {
        private $cineDAO;
        private $localidadDAO;
        private $direccionDAO;

        public function __construct()
        {
            $this->cineDAO = new CineDAO();
            $this->localidadDAO = new LocalidadDAO();
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
            $localidades = $this->localidadDAO->GetAll();

            require_once(VIEWS_PATH."cinesList.php");
        }

        public function Add($nombre, $email, $numeroDeContacto, $calle, $numero, $piso, $departamento, $localidad, $codigoPostal, $provincia, $pais)
        {
            $cine = new Cine($nombre, $email, $numeroDeContacto);
            $direccion = new Direccion($calle, $numero, $piso, $departamento);
            $localidad = new Localidad($localidad, $codigoPostal, $provincia, $pais);

            /* 
                $cine->setDireccionId($direccionId);
                $cine->setLocalidadId($codigoPostal);
            */

            $this->cineDAO->Add($cine);
            $this->localidadDAO->Add($localidad);
            $this->direccionDAO->Add($direccion);

            //ACA SE GUARDARIA EN TABLA CINESxLOCALIDADxDIRECCION?

            $this->ShowAddView();
        }

    }
?>