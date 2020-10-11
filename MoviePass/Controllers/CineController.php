<?php
    namespace Controllers;

    use DAO\CineDAO as CineDAO;
    use Models\Cine\Cine as Cine;

    use DAO\PaisDAO as PaisDAO;
    use DAO\ProvinciaDAO as ProvinciaDAO;
    use DAO\CiudadDAO as CiudadDAO;
    use DAO\DireccionDAO as DireccionDAO;


    use Models\Ubicacion\Direccion as Direccion;
    use Models\Ubicacion\Ciudad as Ciudad;
    use Models\Ubicacion\Provincia as Provincia;
    use Models\Ubicacion\Pais as Pais;

    class CineController
    {
        private $cineDAO;
        private $direccionDAO;
        private $ciudadDAO;
        private $provinciaDAO;
        private $paisDAO;

        public function __construct(){
            $this->cineDAO = new CineDAO();
            $this->localidadDAO = new CiudadDAO();
            $this->direccionDAO = new DireccionDAO();
            $this->paisDAO = new PaisDAO();
        }

        public function ShowAddView()
        {
            if($this->hayUsuario())
            {
                require_once(VIEWS_PATH."addCine.php");
            } 
            else
            {
                require_once(VIEWS_PATH."loginForm.php");
            }
                
        }

        public function ShowListView(){
            $cines = $this->cineDAO->GetAll();
            $direcciones = $this->direccionDAO->GetAll();
            $ciudad = $this->ciudadDAO->GetAll();
            #$paises = $this->paisDAO->GetAll();

            require_once(VIEWS_PATH."cinesList.php");
        }

        public function Add(
            $nombre, $email, $numeroDeContacto, 
            $calle, $numero, $piso, $departamento, 
            $ciudad, $codigoPostal, 
            $provincia, 
            $pais
        )
        {
            $cine = new Cine($nombre, $email, $numeroDeContacto);
            $direccion = new Direccion($calle, $numero, $piso, $departamento);
            $ciudad = new Ciudad($ciudad, $codigoPostal);
            #provincia = new Provincia($provincia);
            #pais = new Pais($pais);

            #$this->paisDAO->getForId($idPais)->getId() obtengo la instancia del pais para usar el metodo getId() y setearlo en localidad   //QUE ES ESTO
            

            $this->cineDAO->Add($cine);
            $this->direccionDAO->Add($direccion);
            $this->ciudadDAO->Add($ciudad);
            #$this->provinciaDAO->Add($provincia);
            #$this->paisDAO->Add($pais);


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