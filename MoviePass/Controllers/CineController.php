<?php
    namespace Controllers;

    use DAO\CineDAO as CineDAO;
    use Cine\Cine as Cine;

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

        public function Add($id, $nombre, $direccion, $localidad)
        {
            $cine = new Cine();
            $cine->setId($id);
            $cine->setNombre($nombre);
            $cine->setDireccion($direccion);
            $cine->setLocalidad($localidad);

            $this->cineDAO->Add($cine);

            $this->ShowAddView();
        }
    }
?>