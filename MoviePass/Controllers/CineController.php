<?php
    namespace Controllers;

    use DAO\CineDAO as CineDAO;
    use DAO\LocalidadDAO as LocalidadDAO;
    use DAO\DireccionDAO as DireccionDAO;
    use DAO\PaisDAO as PaisDAO;
    use Models\Cine\Cine as Cine;

    use DAO\ProvinciaDAO as ProvinciaDAO;
    use DAO\CiudadDAO as CiudadDAO;


    use Models\Ubicacion\Direccion as Direccion;
    use Models\Ubicacion\Localidad as Localidad;
    use Models\Ubicacion\Pais as Pais;
    class CineController
    {
        private $cineDAO;
        private $direccionDAO;
        private $paisDAO;

        public function __construct(){
            $this->cineDAO = new CineDAO();
            $this->localidadDAO = new CiudadDAO();
            $this->direccionDAO = new DireccionDAO();
            $this->paisDAO = new PaisDAO();
        }

        public function ShowAddView(){
            require_once(VIEWS_PATH."addCine.php");
        }

        public function ShowListView(){
            $cines = $this->cineDAO->GetAll();
            $direcciones = $this->direccionDAO->GetAll();
            $localidades = $this->localidadDAO->GetAll();
            #$paises = $this->paisDAO->GetAll();

            require_once(VIEWS_PATH."cinesList.php");
        }

        public function Add(
            $nombre, $email, $numeroDeContacto, $calle, 
            $numero, $piso, $departamento, $localidad, 
            $codigoPostal, $provincia, $idPais
        )
        {
            $cine = new Cine($nombre, $email, $numeroDeContacto);
            $direccion = new Direccion($calle, $numero, $piso, $departamento);
            #$this->paisDAO->getForId($idPais)->getId() obtengo la instancia del pais para usar el metodo getId() y setearlo en localidad
            $localidad = new Localidad($localidad, $codigoPostal, $provincia, $idPais);

            

            $this->cineDAO->Add($cine);
            $this->direccionDAO->Add($direccion);
            $this->ciudadDAO->Add($ciudad);
            $this->provinciaDAO->Add($provincia);
            $this->paisDAO->Add($pais);


            //ACA SE GUARDARIA EN TABLA CINESxLOCALIDADxDIRECCION? 

            $this->ShowAddView();
        }
 

        public function HayUsuario () {

            if(!isset($_SESSION["loggedUser"]))
            {
                $this->ShowLogIn;
                return false;
            }
            else
                return true;
        }


    }
?>