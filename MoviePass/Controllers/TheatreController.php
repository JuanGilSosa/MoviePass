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
use Database\ShowtimesDAO as ShowtimesDAO;
use Database\TicketDAO as TicketDAO;
use Database\MoviesDAO as MoviesDAO;
use PDOException as PDOException;


use Helpers\SessionHelper as SessionHelper;

class TheatreController
{
    private $theatreDAO;
    private $cinemaDAO;
    private $adressDAO;
    private $cityDAO;
    private $provinceDAO;
    private $countryDAO;
    private $showtimeDAO;
    private $ticketDAO;
    private $moviesDAO;

    public function __construct()
    {
        $this->theatreDAO = new TheatreDAO();
        $this->cinemaDAO = new CinemaDAO();
        $this->adressDAO = new AdressDAO();
        $this->cityDAO = new CityDAO();
        $this->provinceDAO = new ProvinceDAO();
        $this->countryDAO = new CountryDAO();
        $this->showtimeDAO = new ShowtimesDAO();
        $this->ticketDAO = new TicketDAO();
        $this->moviesDAO = new MoviesDAO();
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
                ViewsController::ShowTheatres($theatresWithObjects, $message);
            } else {
                if ($theatres != null) {
                    $theatreObject = $this->CreateCine($theatres);
                    array_push($theatresWithObjects, $theatreObject);
                }
                ViewsController::ShowTheatres($theatresWithObjects, $message);
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

    public function ShowAllTheatres($message = "")
    {
        if (SessionHelper::isSession('adminLogged')) {
            $theatres = $this->theatreDAO->GetAll();
            $theatresWithObjects = array();
            if ((is_array($theatres))  and
                (count($theatres) > 1) and
                ($theatres != null)
            ) {
                foreach ($theatres as $theatre) {
                    $theatreWithObject = $this->CreateCine($theatre);
                    array_push($theatresWithObjects, $theatreWithObject);
                }
                ViewsController::ShowAllTheatres($theatresWithObjects, $message);
            } else {
                if ($theatres != null) {
                    $theatreObject = $this->CreateCine($theatres);
                    array_push($theatresWithObjects, $theatreObject);
                }
                ViewsController::ShowAllTheatres($theatresWithObjects, $message);
            }
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
        $isTheatre = $this->theatreDAO->FindTheatreByName($name);

        if (!$isTheatre) {
            $isEmail = $this->theatreDAO->FindTheatreByEmail($email);

            if (!$isEmail) {
                $isPhoneNumber = $this->theatreDAO->FindTheatreByPhoneNumber($phoneNumber);

                if (!$isPhoneNumber) {
                    $adress = $this->adressDAO->CreateAdress($street, (int)$number, (int)$floor, $city, (int)$zipCode, (int)$countryId, (int)$provinceId);

                    if (!is_string($adress)) {

                        $isAdress = $this->adressDAO->FindAdress($adress);

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
        try {
            $this->theatreDAO->Delete($theatreId);
            $message = "Cine eliminado con éxito";
            $this->ShowTheatres($message);
        } catch (PDOException $e) {
            $message = "No pudimos eliminar el cine";
            $this->ShowTheatres($message);
        }
    }

    public function Activate($theatreId)
    {
        try {
            $this->theatreDAO->SetActive($theatreId);
            $message = "Cine activado con éxito";
            $this->ShowAllTheatres($message);
        } catch (PDOException $e) {
            $message = "No pudimos eliminar el cine";
            $this->ShowAllTheatres($message);
        }
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

    public function ShowStatsTheatre()
    {
        if (SessionHelper::isSession('adminLogged'))
            ViewsController::ShowStatsTheatreView();
        else
            ViewsController::ShowLogIn('Inicie sesion para acceder a las estadisticas');
    }

    public function Stats($theatreId)
    {

        $cinemas = $this->cinemaDAO->GetCinemasByTheatreId($theatreId);
        $total = 0;
        $subTotal = 0;
        $countOfTickets = 0;
        $price = 0;
        $totalCapacity = 0;
        $remainder = 0;

        if (is_array($cinemas) && !empty($cinemas)) {

            foreach ($cinemas as $cinema) {

                $showtime = $this->showtimeDAO->GetShowtime_showtimesxcinema($cinema->GetId());

                if (is_array($showtime) && !empty($showtime)) {
                    foreach ($showtime as $s) {
                        $price = $cinema->GetPrice();
                        $countOfTickets = $this->ticketDAO->GetTicketByIdShowtime($s->GetId());
                        $subTotal = ($price * $countOfTickets);
                        $total += $subTotal;
                        $totalCapacity += $cinema->GetCapacity();
                    }
                } elseif (is_object($showtime) && !empty($showtime)) {
                    $price = $cinema->GetPrice();
                    $countOfTickets = $this->ticketDAO->GetTicketByIdShowtime($showtime->GetId());
                    $subTotal = ($price * $countOfTickets);
                    $total += $subTotal;
                    $totalCapacity += $cinema->GetCapacity();
                }
            }
        } elseif (is_object($cinemas) && !empty($cinemas)) {
            $showtime = $this->showtimeDAO->GetShowtime_showtimesxcinema($cinemas->GetId());
            if (is_array($showtime) && !empty($showtime)) {
                $price = $cinemas->GetPrice();
                foreach ($showtime as $s) {
                    $countOfTickets += $this->ticketDAO->GetTicketByIdShowtime($s->GetId());
                }


                $subTotal = ($price * $countOfTickets);
                $total += $subTotal;
                $totalCapacity += $cinemas->GetCapacity();
            } elseif (is_object($showtime) && !empty($showtime)) {
                $price = $cinemas->GetPrice();
                $countOfTickets += $this->ticketDAO->GetTicketByIdShowtime($showtime->GetId());
                $subTotal = ($price * $countOfTickets);
                $total += $subTotal;
                $totalCapacity += $cinemas->GetCapacity();
            }
        }
        $remainder = $totalCapacity - $countOfTickets;
        ViewsController::ShowStatsTheatreView($total, $countOfTickets, $remainder);
    }

    public function ShowStatsShowtime()
    {
        if (SessionHelper::isSession('adminLogged'))
            ViewsController::ShowStatsShowtimeView();
        else
            ViewsController::ShowLogIn('Inicie sesion para acceder a las estadisticas');
    }

    public function StatsShowtime($theatreId = "", $showtimeId = "")
    {

        $showtimes = "";
        $total = 0;
        $countOfTickets = 0;
        $price = 0;
        $totalCapacity = 0;
        $remainder = 0;
        if (!empty($theatreId) && empty($showtimeId)) {
            $showtimes = $this->showtimeDAO->GetShowtimeOfTheatre($theatreId);
            $theatre = $this->theatreDAO->GetTheatreById($theatreId);
            if (!empty($showtimes)) {
                ViewsController::ShowStatsShowtimeView($theatre, $showtimes);
            }
        } else if (!empty($theatreId) && !empty($showtimeId)) {
            $theatre = $this->theatreDAO->GetTheatreById($theatreId);
            $showtimes = $this->showtimeDAO->GetShowtimeById($showtimeId);
            $cinemaId = $this->showtimeDAO->GetCinemaIdxShowtimeId($showtimeId);
            $cinema = $this->cinemaDAO->GetCinemaById($cinemaId);

            if (!empty($showtimes)) {
                $price = $cinema->GetPrice();
                $countOfTickets = $this->ticketDAO->GetTicketByIdShowtime($showtimeId);
                $total = ($price * $countOfTickets);
                $totalCapacity = $cinema->GetCapacity();
                $remainder = $totalCapacity - $countOfTickets;
            }

            ViewsController::ShowStatsShowtimeView($theatre, $showtimes, $total, $countOfTickets, $remainder);
        }
    }


    public function ShowStatsMovies()
    {
        if (SessionHelper::isSession('adminLogged'))
            ViewsController::ShowStatsMoviesView();
        else
            ViewsController::ShowLogIn('Inicie sesion para acceder a las estadisticas');
    }

    public function StatsMovies($movieId = "")
    {
        $movie = $this->moviesDAO->GetMovieById($movieId);
        $showtimes = "";
        $total = 0;
        $countOfTickets = 0;
        $price = 0;
        $totalCapacity = 0;
        $remainder = 0;

        if (!empty($movieId)) {

            $showtimes = $this->showtimeDAO->GetShowtimesByMovieId($movieId);

            if (is_array($showtimes)) {
                foreach ($showtimes as $showtime) {

                    $cinemaId = $this->showtimeDAO->GetCinemaIdxShowtimeId($showtime->GetId());
                    $cinema = $this->cinemaDAO->GetCinemaById($cinemaId);

                    $price = $cinema->GetPrice();
                    $countOfTickets = $this->ticketDAO->GetTicketByIdShowtime($showtime->GetId());
                    $total += ($price * $countOfTickets);
                    $totalCapacity += $cinema->GetCapacity();
                    $remainder = $totalCapacity - $countOfTickets;
                }
            } else if (is_object($showtimes)) {
                $cinemaId = $this->showtimeDAO->GetCinemaIdxShowtimeId($showtimes->GetId());
                $cinema = $this->cinemaDAO->GetCinemaById($cinemaId);

                $price = $cinema->GetPrice();
                $countOfTickets = $this->ticketDAO->GetTicketByIdShowtime($showtimes->GetId());
                $total = ($price * $countOfTickets);
                $totalCapacity = $cinema->GetCapacity();
                $remainder = $totalCapacity - $countOfTickets;
            }

            ViewsController::ShowStatsMoviesView($total, $countOfTickets, $remainder);
        }
    }

    public function StatsProfits($theatreId = "", $startDate = "", $endDate = "")
    {
        $showtimes = $this->showtimeDAO->GetShowtimesOfTheatreBetweenDates($theatreId, $startDate, $endDate);

        $total = 0;
        $countOfTickets = 0;
        $price = 0;


        if (is_array($showtimes)) {
            foreach ($showtimes as $showtime) {

                $cinemaId = $this->showtimeDAO->GetCinemaIdxShowtimeId($showtime->GetId());
                $cinema = $this->cinemaDAO->GetCinemaById($cinemaId);

                $price = $cinema->GetPrice();
                $countOfTickets = $this->ticketDAO->GetTicketByIdShowtime($showtime->GetId());

                if (is_null($countOfTickets)) {
                    $countOfTickets = 0;
                }


                $total += ($price * $countOfTickets);
            }
        } else if (is_object($showtimes)) {
            $cinemaId = $this->showtimeDAO->GetCinemaIdxShowtimeId($showtimes->GetId());
            $cinema = $this->cinemaDAO->GetCinemaById($cinemaId);

            $price = $cinema->GetPrice();
            $countOfTickets = $this->ticketDAO->GetTicketByIdShowtime($showtimes->GetId());
            $total = ($price * $countOfTickets);
        }

        ViewsController::ShowStatsTheatreView("", "", "", $total);
    }
}
