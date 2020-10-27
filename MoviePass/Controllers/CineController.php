<?php
    namespace Controllers;

    use Models\Cine\Cine as Cine;

    #use DAO\CineDAO as CineDAO;
    use Database\CineDAO as CineDAO;

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
 

    use Database\Connection as Connection;

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
            if(SessionController::HayUsuario('adminLogged')){
                ViewsController::ShowAddCineView();
            }else{
                ViewsController::ShowLogIn();
            }   
        }

        public function ListViewCine($message = ""){
            if(SessionController::HayUsuario('adminLogged')){
                ViewsController::ShowCinesList();
            }else{
                ViewsController::ShowLogIn();
            }
        }
        
        public function ShowModify($cineId, $message = ""){
            if(SessionController::HayUsuario('adminLogged')){     
                ViewsController::ShowModifyCine($cineId, $message);
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
/*
        public function Add(
            $nombre, $email, $numeroDeContacto,
            $calle, $numero, $piso,
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
                        $direccion = new Direccion($calle, $numero, $piso, $codigoPostal);
                        $existeDireccion = $this->direccionDAO->FindDireccion($direccion);
                        if(!$existeDireccion)
                        {
                            $existeCodigoPostal = $this->ciudadDAO->GetByCodigoPostal($direccion->getCodigoPostal());
                            if(isset($existeCodigoPostal) && $existeCodigoPostal->getCodigoPostal() == $codigoPostal
                                                          && $existeCodigoPostal->getIdProvincia() == $provincia
                                                          && $existeCodigoPostal->getIdPais() == $pais)
                            { 
                                $this->direccionDAO->Add($direccion);
                                $dirWithId = $this->direccionDAO->FindDireccion($direccion);
                                $cine = new Cine($nombre, $email, $numeroDeContacto,$dirWithId->getId());
                                $this->cineDAO->Add($cine);
                                //ACA SE GUARDARIA EN TABLA CINESxLOCALIDADxDIRECCION? 
                                $message = "Cine agregado con éxito.";
                                ViewsController::ShowCinesList($message);
                            }else{                      // Codigo Postal incorrecto
                                $message = "El código postal ingresado NO se encuentra registrado" ;
                                ViewsController::ShowAddCineView($message);
                            }
                        }else{                          // Direccion repetida
                            $message = "La direccón ingresada ya se encuentra registrada.";
                            ViewsController::ShowAddCineView($message);
                        }
                    }else{                              // Telefono repetido
                        $message = "El teléfono/celular ingresado ya se encuentra registrado.";
                        ViewsController::ShowAddCineView($message);
                    }
                }else{                                  // Email repetido
                    $message = "El email ingresado ya se encuentra registrado.";
                    ViewsController::ShowAddCineView($message);
                }
            }else{                                      // Nombre repetido
                $message = "El nombre ingresado ya se encuentra registrado.";
                ViewsController::ShowAddCineView($message);
            }
        }
*/
        public function Add(
            $nombre, $email, $numeroDeContacto,
            $calle, $numero, $piso,
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
                        $direccion = $this->direccionDAO->CreateDireccion($calle, $numero, $piso, $ciudad, $codigoPostal, $pais, $provincia);
                   
                        if(!is_string($direccion)){
                            $existeDireccion = $this->direccionDAO->FindDireccion($direccion);
                        
                            if(!$existeDireccion)
                            {
                                //var_dump($direccion);
                                    $this->direccionDAO->Add($direccion);
                                    $dirWithId = $this->direccionDAO->FindDireccion($direccion);
                                    $cine = new Cine($nombre, $email, $numeroDeContacto, $dirWithId);
                                    $this->cineDAO->Add($cine);

                                    //ACA SE GUARDARIA EN TABLA CINESxLOCALIDADxDIRECCION? 
                                    
                                    $message = "Cine agregado con éxito.";
                                    ViewsController::ShowCinesList($message);
                                
                            }else{                          // Direccion repetida
                                $message = "La dirección ingresada ya se encuentra registrada.";
                                ViewsController::ShowAddCineView($message);
                            }
                        }else{
                            $message = $direccion;
                            ViewsController::ShowAddCineView($message);
                        }

                    }else{                              // Telefono repetido
                        $message = "El teléfono ingresado ya se encuentra registrado.";
                        ViewsController::ShowAddCineView($message);
                    }
                }else{                                  // Email repetido
                    $message = "El email ingresado ya se encuentra registrado.";
                    ViewsController::ShowAddCineView($message);
                }
            }else{                                      // Nombre repetido
                $message = "El nombre ingresado ya se encuentra registrado.";
                ViewsController::ShowAddCineView($message);
            }
        }

        public function Update($id, $nombre, $email, $numeroDeContacto){
            
            $cineViejo = $this->cineDAO->getCineById($id);
            $existeNombre = $this->cineDAO->FindCineByName($nombre);
            
            if(!$existeNombre || $cineViejo->getNombre() == $nombre)
                {
                    $existeEmail = $this->cineDAO->FindCineByEmail($email);
                    if (!$existeEmail || $cineViejo->getEmail() == $email)
                    {
                        $existeTelefono = $this->cineDAO->FindCineByTelefono($numeroDeContacto);
                        #echo "<script>console.log('$numeroDeContacto'); </script>";

                        if(!$existeTelefono || $cineViejo->getNumeroDeContacto() == $numeroDeContacto)
                        {
                            $cine = new Cine($nombre, $email, $numeroDeContacto, $cineViejo->getIdDireccion());
                            $cine->setId($id);
                            $this->cineDAO->Update($cine);
                            $message = "Cine modificado con éxito";
                            ViewsController::ShowCinesList($message);

                        }else{
                            $message = "El teléfono ingresado ya se encuentra registrado";
                            ViewsController::ShowModifyCine($id, $message);
                        }
                    }else{
                        $message = "El email ingresado ya se encuentra registrado";
                        ViewsController::ShowModifyCine($id, $message);
                    }
                }else{
                    $message = "El nombre ingresado ya se encuentra registrado";
                    ViewsController::ShowModifyCine($id, $message);
                }
        }

        public function Delete($idCine){
            $this->cineDAO->Delete($idCine);
            $message = "Cine eliminado con éxito";
            ViewsController::ShowCinesList($message);
        }

        public function AddSala($nombre, $idCine, $precio, $capacidad){
            $sala = new Sala($this->salaDAO->GetNextId(),$nombre, $precio, $capacidad);
            $cine = $this->cineDAO->getCineById($idCine);
            $salas = $cine->getSalas();
            array_push($salas, $sala);
            $cine->setSalas($salas);
            $this->salaDAO->Add($sala);
        }

        public function get_salaXcine(){
            try {
                $con = Connection::getInstance();

                $query = 'SELECT * FROM salaXcine';
                $salasXcines = $con->execute($query);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
            return $salasXcines;
        }


        //Sin testear - solo testeado logicamente
        public function recuperarCinesConSalas(){

            $salaXcines = $this->get_salaXcine();
            $salas = $this->salaDAO->GetAll();
            $cines = $this->cineDAO->GetAll();

            $allCines = array();
            $salasCine = array();
            foreach($cines as $cine){
                foreach($salaXcines as $salaxcine){
                    if($salaxcine['ID_CINE'] == $cine->getId()){
                        foreach($salas as $sala){
                            if($sala->getId() == $salaxcine['ID_SALA']){
                                array_push($salasCine, $sala);
                                #break; alguna forma para romper con el bucle de salas sin destrozar los otros
                            }
                        }
                    }
                }
                $cine->setSalas($salasCine);
                array_push($allCines, $cine);
            }
        }

    }
?>