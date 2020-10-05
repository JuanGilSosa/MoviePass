<?php
    namespace Controllers;

    use DAO\CineDAO as CineDAO;
    use Models\Cine\Cine as Cine;
    use Models\Ubicacion\Direccion as Direccion;
    use Models\Ubicacion\Localidad as Localidad;

    class CineController
    {
        private $cineDAO;

        public function __construct()
        {
            $this->cineDAO = new CineDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."addCine.php");
        }

        public function ShowListView()
        {
            $studentList = $this->studentDAO->GetAll();

            require_once(VIEWS_PATH."cinesList.php");
        }

        public function Add($nombre, $email, $numeroDeContacto, $calle, $numero, $piso, $departamento, $localidad, $codigoPostal, $provincia, $pais)
        {
            $cine = new Cine($nombre, $email, $numeroDeContacto);
            $direccion = new Direccion($calle, $numero, $piso, $departamento);
            $localidad = new Localidad($localidad, $codigoPostal, $provincia, $pais);

            $cine->setDireccion($direccion);
            $cine->setLocalidad($localidad);

            $this->cineDAO->Add($cine);

            $this->ShowAddView();
        }
    }
?>