<?php namespace Controllers;

    use Models\Users\Admin as Admin;
    use DAO\AdminDAO as AdminDAO;

    use DAO\CineDAO as CineDAO;
    use Model\Cine\Cine as Cine;
    use DAO\PaisDAO as PaisDAO;
    use Models\Ubicacion\Pais as Pais;
    use DAO\ProvinciaDAO as ProvinciaDAO;
    use Models\Ubicacion\Provincia as Provincia;
    use DAO\CiudadDAO as CiudadDAO;
    use Models\Ubicacion\Ciudad as Ciudad;

    use Helpers\SessionHelper as SessionHelper;

    class AdminController{

        private $adminDAO;

        public function __construct(){
            $this->cineController = new CineController();
        }

        public function LoginAdmin($pw){
            if($pw == PW_ADMIN){
                SessionHelper::setOnSession('adminLogged',true);
                #$_SESSION['adminLogged'] = true;
                HomeController::Index();
            }else{
                $message = "Contraseña incorrecta";
                ViewsController::ShowRegisterAdmin($message);
            }
        }
        
        public function ShowAddView(){
            if(SessionHelper::HayUsuario('adminLogged')){
               /* $paisDAO = new PaisDAO(); 
                $paises = $paisDAO->GetAll();
                $provinciaDAO = new ProvinciaDAO();
                $provincias = $provinciaDAO->GetAll();
                $ciudadDAO = new CiudadDAO();
                $ciudades = $ciudadDAO->GetAll();
                */
                ViewsController::ShowAddCineView();
            }else{
                ViewsController::ShowLogIn();
            }
        }
    }
?>