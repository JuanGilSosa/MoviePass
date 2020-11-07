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


use Helpers\SessionHelper as SessionHelper;

class TheatreController
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

    public function ViewAddTheatre($message = "")
    {
        if (SessionHelper::isSession('adminLogged')) {
            ViewsController::ShowAddTheatre();
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public function ShowTheatres($message = "")
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
                ViewsController::ShowTheatres($theatresWithObjects , $message);
            } else {
                if ($theatres != null) {
                    $theatreObject = $this->CreateCine($theatres);
                    array_push($theatresWithObjects , $theatreObject);
                }
                ViewsController::ShowTheatres($theatresWithObjects , $message);
            }
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public function ShowModify($theatreId, $message = "")
    {
        if (SessionHelper::isSession('adminLogged')) {
            ViewsController::ShowModifyTheatre(strval($theatreId), $message);
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public function AddViewSala($theatreId)
    {
        ViewsController::ShowAddCinema($theatreId);
    }

    public function ShowBillboard()
    {
        #$theatres = $this->theatreDAO->GetAll();
        ViewsController::ShowBillboard();
    }

    public function Add(
        $name,
        $email,
        $phoneNumber,
        $street,
        $number,
        $floor,
        $city,
        $zipCode,
        $provinceId,
        $countryId
    ) {
        $message = "";
        var_dump($name);
        $isTheatre = $this->theatreDAO->FindTheatreByName($name);

        if (!$isTheatre) {
            $isEmail = $this->theatreDAO->FindTheatreByEmail($email);

            if (!$isEmail) {
                $isPhoneNumber = $this->theatreDAO->FindTheatreByPhoneNumber($phoneNumber);

                if (!$isPhoneNumber) {
                    //var_dump($countryId);
                    $adress = $this->adressDAO->CreateDireccion($street, (int)$number, (int)$floor, $city, (int)$zipCode, (int)$countryId, (int)$provinceId);
                    
                    if (!is_string($adress)) {

                        $isAdress = $this->adressDAO->FindAdress($adress);
                        //var_dump($adress);
                        if (!$isAdress) {
                            $this->adressDAO->Add($adress);
                            $dirWithId = $this->adressDAO->ChangeObjectById($adress); #$this->adressDAO->FindAdress($adress);
                            $theatre = new Theatre(0, $name, $email, (int)$phoneNumber, $dirWithId);
                            $this->theatreDAO->Add($theatre);

                            //ACA SE GUARDARIA EN TABLA CINESxLOCALIDADxDIRECCION? 

                            $message = "Cine agregado con éxito.";
                            $this->ShowTheatres($message);
                        } else {                          // Direccion repetida
                            $message = "La dirección ingresada ya se encuentra registrada.";
                            ViewsController::ShowAddTheatre($message);
                        }
                    } else {
                        $message = $adress;
                        ViewsController::ShowAddTheatre($message);
                    }
                } else {                              // Telefono repetido
                    $message = "El teléfono ingresado ya se encuentra registrado.";
                    ViewsController::ShowAddTheatre($message);
                }
            } else {                                  // Email repetido
                $message = "El email ingresado ya se encuentra registrado.";
                ViewsController::ShowAddTheatre($message);
            }
        } else {                                      // Nombre repetido
            $message = "El nombre ingresado ya se encuentra registrado.";
            ViewsController::ShowAddTheatre($message);
        }
    }

    public function Update($id, $name, $email, $phoneNumber)
    {


        $oldCine = $this->theatreDAO->GetTheatreById(strval($id)); #busca y guarda la informacion vieja del cine
        $isTheatre = $this->theatreDAO->FindTheatreByName($name);     #verifica que el nombre nuevo no exista en la base de datos

        if (!empty($oldCine) && $oldCine->GetName() != $name || $oldCine->GetEmail() != $email || $oldCine->GetPhoneNumber() != $phoneNumber) {

            if (!$isTheatre || $oldCine->GetName() == $name) {

                $isEmail = $this->theatreDAO->FindTheatreByEmail($email);

                if (!$isEmail || $oldCine->GetEmail() == $email) {
                    $isPhoneNumber = $this->theatreDAO->FindTheatreByPhoneNumber($phoneNumber);
                    #echo "<script>console.log('$phoneNumber'); </script>";

                    if (!$isPhoneNumber || $oldCine->GetPhoneNumber() == $phoneNumber) {
                        $theatre = new Theatre($oldCine->getId(), $name, $email, $phoneNumber, $oldCine->GetAdress());
                        #$theatre->setId($id);
                        $this->theatreDAO->Update($theatre);
                        $message = "Cine modificado con éxito";
                        $this->ShowTheatres($message);
                    } else {
                        $message = "El teléfono ingresado ya se encuentra registrado";
                        ViewsController::ShowModifyTheatre($id, $message);
                    }
                } else {
                    $message = "El email ingresado ya se encuentra registrado";
                    ViewsController::ShowModifyTheatre($id, $message);
                }
            } else {
                $message = "El nombre ingresado ya se encuentra registrado";
                ViewsController::ShowModifyTheatre($id, $message);
            }
        } else {
            $this->ShowTheatres();
        }
    }

    public function Delete($theatreId)
    {
        $this->theatreDAO->Delete($theatreId);
        $message = "Cine eliminado con éxito";
        $this->ShowTheatres($message);
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
