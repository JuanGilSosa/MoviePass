<?php

namespace Controllers;

use Database\Connection as Connection;
use Database\TheatreDAO as TheatreDAO;
use Database\AdressDAO as AdressDAO;
use Database\CinemaDAO;
use Database\CityDAO as CityDAO;
use Database\ProvinceDAO as ProvinceDAO;
use Database\CountryDAO as CountryDAO;
//use Database\salaXcineDAO as salaXcineDAO;
use Models\Theatre\Cinema as Cinema;
use PDOException as PDOException;

class CinemaController
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
       // $this->salaxcineDAO = new salaXcineDAO();
    }

    public function ViewAddCinema($theatreId)
    {
        ViewsController::ShowAddCinema($theatreId);
    }

    public function ShowCinemasByTheatre($theatreId)
    {
        
        ViewsController::ShowCinemasByTheatre($theatreId);
    }

    public function AddCinema($theatreId = "", $name = "", $type = "", $price = "", $capacity = "")
    {
        try{
            $theatre = $this->theatreDAO->GetTheatreById($theatreId);
            if (!is_null($theatre)) {
                if ($this->FindCinemaByName($theatre, $name) == 0) {
                    $cinema = new Cinema(0, $name, $price, $capacity, $type);
                    $cinemas = $theatre->GetCinemas();
                    array_push($cinemas, $cinema);
                    $theatre->SetCinemas($cinemas);
                    #deber de modificar donde esta el theatre {hacer update}
                    $this->cinemaDAO->Add($cinema);
                    
                    $lastIdSala = $this->cinemaDAO->GetLastId(); #uso esto porque como el objeto tiene 0 - no sirve
                    $theatreId = $theatre->GetId();

                    $this->cinemaDAO->Add_cinemasXtheatre($lastIdSala, $theatreId);

                    $theatreController = new TheatreController();
                    $theatreController->ShowTheatres();

                } else {
                    #Es porque la sala isCinema 
                }
            }
        }catch (PDOException $ex){
            
        }
    }

    public function FindCinemaByName($theatre, $cinemaName)
    {
        $isCinema = 0;
        $cinemas = $theatre->GetCinemas();
        if (is_array($cinemas)) {
            foreach ($cinemas as $cinema) {
                if (strcasecmp($cinema->GetName, $cinemaName)) {
                    $isCinema = 1;
                    break;
                }
            }
        }
        return $isCinema;
    }
}
