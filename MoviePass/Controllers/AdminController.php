<?php namespace Controllers;

    use Models\Users\Admin as Admin;

    use DAO\MovieDAO as MovieDAO;
    use Model\Theatre\Theatre as Theatre;
    use DAO\CountryDAO as CountryDAO;
    use Models\Location\Country as Country;
    use DAO\ProvinceDAO as ProvinceDAO;
    use Models\Location\Province as Province;
    use DAO\CityDAO as CityDAO;
    use Models\Location\City as City;

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
                ViewsController::ShowAddCineView();
            }else{
                ViewsController::ShowLogIn();
            }
        }
    }
?>