<?php

namespace Controllers;

use Database\TicketDAO as TicketDAO;
use Database\ShowtimesDAO as ShowtimesDAO;
use Database\CinemaDAO as CinemaDAO;
use Database\MoviesDAO as MoviesDAO;
use Models\Shopping\Ticket as Ticket;
use Models\Shopping\Cart as Cart;

use PDOException as PDOException;

use Controllers\ShowtimeController as ShowtimeController;

use Helpers\SessionHelper;

class CartController
{

    private $ticketDAO;
    private $showTimeDAO;
    private $cinemaDAO;
    private $movieDAO;
    private $cart;

    public function __construct()
    {
        $this->ticketDAO = new TicketDAO();
        $this->showTimeDAO = new ShowtimesDAO();
        $this->cinemaDAO = new CinemaDAO();
        $this->movieDAO = new MoviesDAO();
        $this->cart = new Cart();
    }

    public function AddShowTime($idShowTime)
    {
        $showTimeController = new ShowtimeController();

        $showTime = $this->showTimeDAO->GetShowtimeById($idShowTime);
        if (!empty($showTime) && is_object($showTime)) { #trato asi la condicion porque solo voy a traer una funcion, nada mas(object)

            $soldTickets = $this->ticketDAO->GetCountTickets();

            $cinemaId = $this->showTimeDAO->GetCinemaIdxShowtimeId($idShowTime);
            $cinema = $this->cinemaDAO->GetCinemaById($cinemaId);
            $movie = $this->movieDAO->getMovieById($showTime->GetMovie());

            $capacity = $cinema->GetCapacity();

            if ($soldTickets < $capacity) {

                $showTime->SetMovie($movie);
                $showTime->SetCinema($cinema);

                #Reemplazo el ticket en el session simplemente incrementando la variable
                if ($this->ReplaceTicketIfExists($showTime) == false) {
                    if (!SessionHelper::isSession('CART')) {
                        SessionHelper::SetOnIndex('CART', 0, new Ticket(0, $showTime)); #$_SESSION['CART'][0] = $myTicket;
                    } else {
                        $length = SessionHelper::LengthOfKey('CART');
                        SessionHelper::SetOnIndex('CART', intval($length), new Ticket(0, $showTime)); #$_SESSION['CART'][$length] = $myTicket;
                    }
                }
                $showTimeController->ShowShowtimes('Agrega otra funcion o finaliza tu compra en el carrito');
            } else {
                $showTimeController->ShowShowtimes('NO HAY TICKETS PARA ESTA FUNCION');
            }
        }
    }

    public function ShowCart($message = "")
    {
        ViewsController::ShowCartView($message);
    }
    /*
            Remplasa un ticket si existe en la session, dado que si el usuario ingresa dos veces la misma funcion debe incrementar
            el contador de ticket
        */
    public function ReplaceTicketIfExists($showtime)
    {
        if (SessionHelper::isSession('CART')) {
            foreach (SessionHelper::GetValue('CART') as $index => $ticket) {
                if ($ticket->GetShowtime()->GetId() == $showtime->GetId()) {
                    $ticket->IncrementNumberOfTickets();
                    SessionHelper::SetOnIndex('CART', $index, $ticket);
                    return true;
                }
            }
        }
        return false;
    }

    public function EmtpyCart()
    {
        SessionHelper::DestroySession('CART');
        $this->ShowCart();
    }

    public function RemoveTicket($numberOfTicket)
    {
        if (SessionHelper::isSession('CART')) {
            foreach (SessionHelper::GetValue('CART') as $index => $ticket) {
                if ($ticket->GetNumberTicket() == $numberOfTicket) {
                    SessionHelper::UnsetValue('CART', $index);
                    break;
                }
            }
            $this->ShowCart();
        }
    }

    public function ProcessOrder()
    {
        if (SessionHelper::isSession('CART') && SessionHelper::isSession('userLogged')) {
            ViewsController::ShowProcessOrderView();
        } else if (!SessionHelper::isSession('userLogged')) {
            ViewsController::ShowLogIn();
        } else {
            $this->ShowCart('No hay productos en el carrito');
        }
    }

    public function ConfirmPayment()
    {
        if (SessionHelper::isSession('CART')) {
            $ticketController = new TicketController();
            $cart = SessionHelper::GetValue('CART');
            foreach ($cart as $index => $ticket) {
                $ticketController->AddTicket($ticket);
            }
            ViewsController::ShowTicketsListView(SessionHelper::GetValue('CART'));
        }
    }
}
