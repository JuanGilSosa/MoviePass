<?php
    namespace Controllers;

    use Models\Cine\Cine as Cine;

    use DAO\CineDAO as CineDAO;
    use DAO\DireccionDAO as DireccionDAO;
    use DAO\CiudadDAO as CiudadDAO;
    use DAO\ProvinciaDAO as ProvinciaDAO;
    use DAO\PaisDAO as PaisDAO;

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
            $this->direccionDAO = new DireccionDAO();
            $this->ciudadDAO = new CiudadDAO();
            $this->provinciaDAO = new ProvinciaDAO();
            $this->paisDAO = new PaisDAO();
        }

        public function ShowAddView()
        {
            if($this->HayUsuario())
            {
                require_once(VIEWS_PATH."addCine.php");
            } 
            else
            {
                require_once(VIEWS_PATH."loginForm.php");
            }
                
        }

        public function ShowListView(){
            if($this->HayUsuario())
            {
                $cines = $this->cineDAO->GetAll();
                $direccionDAO = new DireccionDAO(); 
                $ciudadDAO = new CiudadDAO();
                $provinciaDAO = new ProvinciaDAO();
                $paisDAO = new PaisDAO();
                
                require_once(VIEWS_PATH."cinesList.php");
            } 
            else
            {
                require_once(VIEWS_PATH."loginForm.php");
            }

        }
        
        public function ShowModifyCine($cineId){
            if($this->HayUsuario())
            {
                $miCine = $this->cineDAO->getCineById($cineId);
                require_once(VIEWS_PATH."modifyCine.php");
            } 
            else
            {
                require_once(VIEWS_PATH."loginForm.php");
            }

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
            #$ciudad = new Ciudad($ciudad, $codigoPostal);
            #$provincia = new Provincia($provincia);
            #$pais = new Pais($pais);

            

            $this->cineDAO->Add($cine);
            $this->direccionDAO->Add($direccion);
            #$this->ciudadDAO->Add($ciudad);
            #$this->provinciaDAO->Add($provincia);
            #$this->paisDAO->Add($pais);


            //ACA SE GUARDARIA EN TABLA CINESxLOCALIDADxDIRECCION? 

            $this->ShowAddView();
        }
 

        public function HayUsuario () {

            if(!isset($_SESSION["loggedUser"]))
            {
                #$this->ShowLogIn;
                return false;
            }
            else{
                return true;
            }
        }


    }
?>