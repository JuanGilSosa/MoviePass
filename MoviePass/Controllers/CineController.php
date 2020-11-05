<?php

namespace Controllers;

use Models\Theatre\Theatre as Theatre;
use Database\Connection as Connection;
use Database\TheatreDAO as TheatreDAO;
use Database\AdressDAO as AdressDAO;
use Database\CityDAO as CityDAO;
use Database\ProvinceDAO as ProvinceDAO;
use Database\CountryDAO as CountryDAO;
use Database\CinemaDAO as CinemaDAO;

use Models\Ubicacion\Direccion as Direccion;
use Models\Ubicacion\Ciudad as Ciudad;
use Models\Ubicacion\Provincia as Provincia;
use Models\Ubicacion\Pais as Pais;
use Models\Theatre\Sala as Sala;

use Helpers\SessionHelper as SessionHelper;

class CineController
{
    private $theatreDAO;
    private $cinemaDAO;
    private $adressDAO;
    private $cityDAO;
    private $provinceDAO;
    private $countryDAO;

    public function __construct()
    {
        $this->theatreDAO = new TheatreDAO();
        $this->cinemaDAO = new CinemaDAO();
        $this->adressDAO = new AdressDAO();
        $this->cityDAO = new CityDAO();
        $this->provinceDAO = new ProvinceDAO();
        $this->countryDAO = new CountryDAO();
    }

    public function AddViewCine($message = "")
    {
        if (SessionHelper::isSession('adminLogged')) {
            ViewsController::ShowAddCineView();
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public function ListViewCine($message = "")
    {
        if (SessionHelper::isSession('adminLogged')) {
            $theatres = $this->theatreDAO->GetAllActive();
            $theatresWithObjects = array();
            if ((is_array($theatres))  and
                (count($theatres) > 1) and
                ($theatres != null)
            ) {
                foreach ($theatres as $theatre) {
                    $theatreWithObject = $this->CreateCine($theatre);
                    array_push($theatresWithObjects, $theatreWithObject);
                }
                ViewsController::ShowCinesList($theatresWithObjects , $message);
            } else {
                if ($theatres != null) {
                    $theatreObject = $this->CreateCine($theatres);
                    array_push($theatresWithObjects , $theatreObject);
                }
                ViewsController::ShowCinesList($theatresWithObjects , $message);
            }
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public function ShowModify($theatreId, $message = "")
    {
        if (SessionHelper::isSession('adminLogged')) {
            ViewsController::ShowModifyCine(strval($theatreId), $message);
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public function AddViewSala($theatreId)
    {
        ViewsController::ShowAddSala($theatreId);
    }

    public function ShowCartelera()
    {
        #$theatres = $this->theatreDAO->GetAll();
        ViewsController::ShowCartelera();
    }

    public function Add(
        $name,
        $email,
        $phoneNumber,
        $calle,
        $number,
        $floor,
        $city,
        $zipCode,
        $provinceId,
        $countryId
    ) {
        $message = "";
        $theatre = $this->theatreDAO->FindTheatreByName($name);

        if (!$theatre) {
            $email = $this->theatreDAO->FindTheatreByEmail($email);
            if (!$email) {
                $phoneNumber = $this->theatreDAO->FindTheatreByPhoneNumber($phoneNumber);

                if (!$phoneNumber) {

                    $adress = $this->adressDAO->CreateDireccion($calle, (int)$number, (int)$floor, $city, (int)$zipCode, (int)$countryId, (int)$provinceId);

                    if (!is_string($adress)) {

                        $adress = $this->adressDAO->FindAdress($adress);

                        if (!$adress) {
                            $this->adressDAO->Add($adress);
                            $dirWithId = $this->adressDAO->ChangeObjectById($adress); #$this->adressDAO->FindAdress($adress);
                            $theatre = new Theatre(0, $name, $email, (int)$phoneNumber, $dirWithId);
                            $this->theatreDAO->Add($theatre);

                            //ACA SE GUARDARIA EN TABLA CINESxLOCALIDADxDIRECCION? 

                            $message = "Cine agregado con éxito.";
                            $this->ListViewCine($message);
                        } else {                          // Direccion repetida
                            $message = "La dirección ingresada ya se encuentra registrada.";
                            ViewsController::ShowAddCineView($message);
                        }
                    } else {
                        $message = $adress;
                        ViewsController::ShowAddCineView($message);
                    }
                } else {                              // Telefono repetido
                    $message = "El teléfono ingresado ya se encuentra registrado.";
                    ViewsController::ShowAddCineView($message);
                }
            } else {                                  // Email repetido
                $message = "El email ingresado ya se encuentra registrado.";
                ViewsController::ShowAddCineView($message);
            }
        } else {                                      // Nombre repetido
            $message = "El name ingresado ya se encuentra registrado.";
            ViewsController::ShowAddCineView($message);
        }
    }

    public function Update($id, $name, $email, $phoneNumber)
    {


        $oldCine = $this->theatreDAO->GetTheatreById(strval($id));
        $theatre = $this->theatreDAO->FindTheatreByName($name);

        if (
            !empty($oldCine) &&
            //strcmp($oldCine->GetName(), $name) != 0 && 
            //strcmp($oldCine->GetEmail(), $email) != 0 && 
            $oldCine->GetName() != $name ||
            $oldCine->GetEmail() != $email ||
            $oldCine->GetPhoneNumber() != $phoneNumber
        ) {
            if (!$theatre || $oldCine->GetName() == $name) {

                $email = $this->theatreDAO->FindTheatreByEmail($email);

                if (!$email || $oldCine->GetEmail() == $email) {
                    $phoneNumber = $this->theatreDAO->FindTheatreByPhoneNumber($phoneNumber);
                    #echo "<script>console.log('$phoneNumber'); </script>";

                    if (!$phoneNumber || $oldCine->GetPhoneNumber() == $phoneNumber) {
                        $theatre = new Theatre($oldCine->getId(), $name, $email, $phoneNumber, $oldCine->GetAdress());
                        #$theatre->setId($id);
                        $this->theatreDAO->Update($theatre);
                        $message = "Cine modificado con éxito";
                        $this->ListViewCine($message);
                    } else {
                        $message = "El teléfono ingresado ya se encuentra registrado";
                        ViewsController::ShowModifyCine($id, $message);
                    }
                } else {
                    $message = "El email ingresado ya se encuentra registrado";
                    ViewsController::ShowModifyCine($id, $message);
                }
            } else {
                $message = "El nombre ingresado ya se encuentra registrado";
                ViewsController::ShowModifyCine($id, $message);
            }
        } else {
            $this->ListViewCine();
        }
    }

    public function Delete($theatreId)
    {
        $this->theatreDAO->Delete($theatreId);
        $message = "Cine eliminado con éxito";
        $this->ListViewCine($message);
    }

    public function CreateCine($mappedTheatre)
    {
        // Busco objetoDireccion y lo seteo
        $objDireccion = $this->adressDAO->GetAdressById($mappedTheatre->GetAdress());
        $mappedTheatre->SetAdress($objDireccion);
        // Busco la city y la seteo en la adress del theatre mapeado
        $objCiudad = $this->cityDAO->GetByZipCode($objDireccion->GetCity());
        $mappedTheatre->GetAdress()->SetCity($objCiudad);
        // Busco la provincia y la seteo en la city del theatre seteado
        $objProvincia = $this->provinceDAO->GetById($objCiudad->GetProvince());
        $mappedTheatre->GetAdress()->GetCity()->SetProvince($objProvincia);
        // Busco el pais y lo seteo en la provincia del theatre seteado
        $objPais = $this->countryDAO->GetById($objProvincia->GetCountry());
        $mappedTheatre->GetAdress()->GetCity()->GetProvince()->SetCountry($objPais);

        return $mappedTheatre;
    }
}
