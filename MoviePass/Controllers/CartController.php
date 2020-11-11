<?php namespace Controllers; 
    
    use Database\TicketDAO as TicketDAO;
    use Database\ShowtimesDAO as ShowtimesDAO;
    use Database\CinemaDAO as CinemaDAO;
    use Database\MoviesDAO as MoviesDAO;
    use Models\Shopping\Ticket as Ticket;
    use Models\Shopping\Cart as Cart;

    use Controllers\ShowtimeController as ShowtimeController;

    use Helpers\SessionHelper;

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
/*
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
        }*/

        public function AddShowTime($idShowTime){

            $showTime = $this->showTimeDAO->GetShowtimeById($idShowTime);
        
            if(!empty($showTime) && is_object($showTime)){ #trato asi la condicion porque solo voy a traer una funcion, nada mas(object)
                $cinemaId = $this->showTimeDAO->GetCinemaIdxShowtimeId($idShowTime);
                $cinema = $this->cinemaDAO->GetCinemaById($cinemaId);
                $movie = $this->movieDAO->getMovieById($showTime->GetMovie());
                $showTime->SetMovie($movie);
                $showTime->SetCinema($cinema);
                
                #Reemplazo el ticket en el session simplemente incrementando la variable
                if($this->ReplaceTicketIfExists($showTime)==false){ 
                    if(!SessionHelper::isSession('CART')){
                        SessionHelper::SetOnIndex('CART',0,new Ticket(0,$showTime));#$_SESSION['CART'][0] = $myTicket;
                    }else{
                        $length = SessionHelper::LengthOfKey('CART');
                        SessionHelper::SetOnIndex('CART',intval($length),new Ticket($length,$showTime));#$_SESSION['CART'][$length] = $myTicket;
                    }
                }
                $showTimeController = new ShowtimeController();
                $showTimeController->ShowShowtimes('Agrega otra funcion o finaliza tu compra en el carrito');
            }
        }

        public function ShowCart(){
            ViewsController::ShowCartView();
        }
        /*
            Remplasa un ticket si existe en la session, dado que si el usuario ingresa dos veces la misma funcion debe incrementar
            el contador de ticket
        */
        public function ReplaceTicketIfExists($showtime){
            if(SessionHelper::isSession('CART')){
                foreach (SessionHelper::GetValue('CART') as $index => $ticket) {
                    if($ticket->GetShowtime()->GetId()==$showtime->GetId()){
                        $ticket->SetNumberOfTickets();
                        SessionHelper::SetOnIndex('CART',$index,$ticket);
                        return true;
                    }
                }
            }
            return false;
        }

        public function EmtpyCart(){
            SessionHelper::DestroySession('CART');
            $this->ShowCart();
        }

        public function RemoveTicket($numberOfTicket){
            if(SessionHelper::isSession('CART')){
                foreach (SessionHelper::GetValue('CART') as $index => $ticket) {
                    if($ticket->GetNumberTicket() == $numberOfTicket){
                        SessionHelper::UnsetValue('CART',$index);
                        break;
                    }
                }
                $this->ShowCart();
            }
        }

        public function ProcessOrder(){
            if(SessionHelper::isSession('CART') && SessionHelper::isSession('adminLogged') || SessionHelper::isSession('userLogged')){
                $cart = SessionHelper::GetValue('CART');
                ViewsController::ShowProcessOrder($cart);
            }else if(!SessionHelper::isSession('adminLogged') || !SessionHelper::isSession('userLogged')){
                ViewsController::ShowLogIn();
            }
        }

    }

?>