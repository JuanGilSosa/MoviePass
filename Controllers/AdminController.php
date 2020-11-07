<?php namespace Controllers;

    use Models\Users\Admin as Admin;


    use Helpers\SessionHelper as SessionHelper;

    class AdminController{

        private $adminDAO;
        

        public function LoginAdmin($pw){
            if($pw == PW_ADMIN){
                SessionHelper::SetSession('adminLogged',true);
                #$_SESSION['adminLogged'] = true;
                HomeController::Index();
            }else{
                $message = "Contraseña incorrecta";
                ViewsController::ShowRegisterAdmin($message);
            }
        }
        
        public function ShowAddView(){
            if(SessionHelper::isSession('adminLogged')){
               /* $paisDAO = new CountryDAO(); 
                $paises = $paisDAO->GetAll();
                $provinciaDAO = new ProvinceDAO();
                $provincias = $provinciaDAO->GetAll();
                $ciudadDAO = new CityDAO();
                $ciudades = $ciudadDAO->GetAll();
                */
                ViewsController::ShowAddTheatre();
            }else{
                ViewsController::ShowLogIn();
            }
        }
    }
?>