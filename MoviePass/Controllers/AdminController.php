<?php namespace Controllers;

    use Models\Users\Admin as Admin;
    use DAO\AdminDAO as AdminDAO;

    use DAO\PaisDAO as PaisDAO;
    use Models\Ubicacion\Pais as Pais;
    use DAO\ProvinciaDAO as ProvinciaDAO;
    use Models\Ubicacion\Provincia as Provincia;
    use DAO\CiudadDAO as CiudadDAO;
    use Models\Ubicacion\Ciudad as Ciudad;

    class AdminController{

        private $adminDAO;

        public function __construct(){
            $this->cineController = new CineController();
        }

        public function LoginAdmin($pw){
            if($pw == PW_ADMIN){
                SessionController::setOnSession('adminLogged',true);
                #$_SESSION['adminLogged'] = true;
                $this->ShowAddView();
            }else{
                ViewsController::ShowRegisterAdmin();
            }
        }
        
        public function ShowAddView(){
            
            if($this->HayAdmin('adminLogged')){
                $paisDAO = new PaisDAO(); 
                $paises = $paisDAO->GetAll();
                $provinciaDAO = new ProvinciaDAO();
                $provincias = $provinciaDAO->GetAll();
                $ciudadDAO = new CiudadDAO();
                $ciudades = $ciudadDAO->GetAll();

                ViewsController::ShowAddCineView();
            }else{
                ViewsController::ShowLogIn();
            }
        }
    }
?>