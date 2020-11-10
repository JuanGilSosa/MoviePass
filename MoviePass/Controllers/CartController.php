<?php namespace Controllers; 
    
    use Database\TicketDAO as TicketDAO;
    use Database\ShowtimesDAO as ShowtimesDAO;
    use Database\CinemaDAO as CinemaDAO;
    use Database\MoviesDAO as MoviesDAO;
    use Models\Shopping\Ticket as Ticket;
    use Models\Shopping\Cart as Cart;
    class CartController{

        private $ticketDAO;
        private $showTimeDAO;
        private $cinemaDAO;
        private $movieDAO;
        private $cart;

        public function __construct(){
            $this->ticketDAO = new TicketDAO();
            $this->showTimeDAO = new ShowtimesDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->movieDAO = new MoviesDAO();
            $this->cart = new Cart();
        }

        public function AddShowtime($idShowTime){
            $showTime = $this->showTimeDAO->GetShowtimeById($idShowTime);
            if(!empty($showTime) && is_object($showTime)){ #trato asi la condicion porque solo voy a traer una funcion, nada mas(object)
                $cinema = $this->cinemaDAO->GetCinema_showtimesXcinema($idShowTime);
                $movie = $this->movieDAO->getMovieById($showTime->GetMovie());
                $showTime->SetMovie($movie);
                $showTime->SetCinema($cinema);
                $myTicket =  new Ticket(0,$showTime); echo 'VER LINEA 32 CartController';
                $this->cart->PushTicket($myTicket);
                ViewsController::ShowCartView($this->cart);
            }
        }

        public function AddTicket($arrOfTickets){
            $this->ticketDAO->Add($arrOfTickets);
        }
    }

?>