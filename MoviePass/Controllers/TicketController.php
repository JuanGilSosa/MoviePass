<?php namespace Controllers; 
    
    use Database\TicketDAO as TicketDAO;
    use Database\CinemaDAO as CinemaDAO;
    use Database\ShowtimesDAO as ShowtimesDAO;
    use Database\MoviesDAO as MoviesDAO;

    use Helpers\SessionHelper;

    class TicketController{
        
        private $ticketDAO;
        private $cinemaDAO;
        private $showtimeDAO;
        private $movieDAO;

        public function __construct(){
            $this->ticketDAO = new TicketDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->showtimeDAO = new ShowtimesDAO();
            $this->movieDAO = new MoviesDAO();
        }

        #Sube el ticket a la base de datos
        public function AddTicket($ticket){
            if(!empty($ticket)){
                $this->ticketDAO->Add($ticket); 
                $this->ticketDAO->Add_ticketxmember(intval(SessionHelper::GetValue('userLogged')->GetId()), $this->ticketDAO->GetLastId());
            }   
        }

        public function ShowTicketsOfMember($idMember){

            $tickets = $this->ticketDAO->GetTicketByIdMember($idMember);
            $ticketsArrayAux = array();
            $ticketsArrayAux2 = array();

            if(!is_array($tickets) && !empty($tickets)){
                array_push($ticketsArrayAux, $tickets);
            }elseif(!empty($tickets)){
                $ticketsArrayAux = $tickets;
            }
            foreach($ticketsArrayAux as $ticket){

                $showtime = $this->showtimeDAO->GetShowtimeById($ticket->GetShowtime());
                
                $movie = $this->movieDAO->getMovieById($showtime->GetMovie());

                $cinemaId = $this->showtimeDAO->GetCinemaIdxShowtimeId($showtime->GetId());
                $cinema = $this->cinemaDAO->GetCinemaById($cinemaId);
                
                $showtime->SetMovie($movie);
                $showtime->SetCinema($cinema);

                $ticket->SetShowtime($showtime);

                array_push($ticketsArrayAux2, $ticket);
            }
            $this->ShowTicketList($ticketsArrayAux2);
        }

        public function ShowTicketList($tickets){
            ViewsController::ShowTicketsListView($tickets);
        }
    }

?>