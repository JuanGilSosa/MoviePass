<?php
    namespace Controllers;

    use Models\Cine\Cine as Cine;

    use DAO\CineDAO as CineDAO;
    use DAO\DireccionDAO as DireccionDAO;
    use DAO\CiudadDAO as CiudadDAO;
    use DAO\ProvinciaDAO as ProvinciaDAO;
    use DAO\PaisDAO as PaisDAO;
    use DAO\SalaDAO as SalaDAO;

    use Models\Ubicacion\Direccion as Direccion;
    use Models\Ubicacion\Ciudad as Ciudad;
    use Models\Ubicacion\Provincia as Provincia;
    use Models\Ubicacion\Pais as Pais;
    use Models\Cine\Sala as Sala;
 
    class CineController
    {
        private $cineDAO;
        private $salaDAO;
        private $direccionDAO;
        private $ciudadDAO;
        private $provinciaDAO;
        private $paisDAO;

        public function __construct(){
            $this->cineDAO = new CineDAO();
            $this->salaDAO = new SalaDAO();
            $this->direccionDAO = new DireccionDAO();
            $this->ciudadDAO = new CiudadDAO();
            $this->provinciaDAO = new ProvinciaDAO();
            $this->paisDAO = new PaisDAO();
        }

        public function AddViewCine($message = ""){
            if($this->HayUsuario('adminLogged')){
                ViewsController::ShowAddCineView();
            }else{
                ViewsController::ShowLogIn();
            }   
        }

        public function ListViewCine($message = ""){
            if(SessionController::HayUsuario('adminLogged')){
                $cines = $this->cineDAO->GetAll();
                $direccionDAO = new DireccionDAO(); 
                $ciudadDAO = new CiudadDAO();
                $provinciaDAO = new ProvinciaDAO();
                $paisDAO = new PaisDAO();
                
                ViewsController::ShowCinesList();
            }else{
                ViewsController::ShowLogIn();
            }

        }
        
        public function ShowModifyCine($cineId){
            if(SessionController::HayUsuario('adminLogged')){
                $miCine = $this->cineDAO->getCineById($cineId);
                ViewsController::ShowModifyCine();
            }else{
                ViewsController::ShowLogIn();
            }
        }

        public function AddViewSala(){
            $cines = $this->cineDAO->GetAll();
            ViewsController::ShowAddSala();
        }

        public function ShowCartelera(){
            $cines = $this->cineDAO->GetAll();
            ViewsController::ShowCartelera();
        }

        public function Add(
            $nombre, $email, $numeroDeContacto,
            $calle, $numero, $piso, $departamento, 
            $ciudad, $codigoPostal, $pais, $provincia)
        {
            $message = "";
            $existeCine = $this->cineDAO->FindCineByName($nombre);

            if(!$existeCine)
            {
                $existeEmail = $this->cineDAO->FindCineByEmail($email);
                if(!$existeEmail)
                {
                    $existeTelefono = $this->cineDAO->FindCineByTelefono($numeroDeContacto);

                    if(!$existeTelefono)
                    {
                        $direccion = new Direccion($calle, $numero, $piso, $departamento, $codigoPostal);
            
                        $existeDireccion = $this->direccionDAO->FindDireccion($direccion);

                        if(!$existeDireccion)
                        {
                            $existeCodigoPostal = $this->ciudadDAO->GetByCodigoPostal($direccion->getCodigoPostal());

                            

                            if(isset($existeCodigoPostal) && $existeCodigoPostal->getCodigoPostal() == $codigoPostal
                                                          && $existeCodigoPostal->getIdProvincia() == $provincia
                                                          && $existeCodigoPostal->getIdPais() == $pais)
                            { 
                                $message = "Cine agregado con éxito.";

                                $this->direccionDAO->Add($direccion);
                                $dirWithId = $this->direccionDAO->FindDireccion($direccion);
                    
                                $cine = new Cine($nombre, $email, $numeroDeContacto,$dirWithId->getId());

                                $this->cineDAO->Add($cine);
            
                                //ACA SE GUARDARIA EN TABLA CINESxLOCALIDADxDIRECCION? 

                                $this->ListViewCine($message);
                            }else{
                                $message = "El código postal ingresado NO se encuentra registrado" .
                                "cod:" . $codigoPostal. "prov: ".$provincia ."pais".$pais;
                                $this->AddViewCine($message);
                            }
                            

                        }else{
                            $message = "La direccón ingresada ya se encuentra registrada.";
                            $this->AddViewCine($message);
                        }
                    }else{
                        $message = "El teléfono/celular ingresado ya se encuentra registrado.";
                        $this->AddViewCine($message);
                    }
                }else{
                    $message = "El email ingresado ya se encuentra registrado.";
                    $this->AddViewCine($message);
                }
            }else{

                $message = "El nombre ingresado ya se encuentra registrado.";
                $this->AddViewCine($message);

            }
        }

        public function Update(
            $id, $nombre, $email, $numeroDeContacto, $direccion
        ){
            $cine = new Cine($nombre, $email, $numeroDeContacto, $direccion);
            $cine->setId($id);
            $this->cineDAO->Update($cine);

            $this->ListViewCine();
        }

        public function Delete($idCine){
            $this->cineDAO->Delete($idCine);
            $this->ListViewCine();
        }

        public function AddSala($nombre, $idCine, $precio, $capacidad){
            $sala = new Sala($this->salaDAO->GetNextId(),$nombre, $precio, $capacidad);
            $cine = $this->cineDAO->getCineById($idCine);
            $salas = $cine->getSalas();
            array_push($salas, $sala);
            $cine->setSalas($salas);
            $this->salaDAO->Add($sala);
        }

    }
?>