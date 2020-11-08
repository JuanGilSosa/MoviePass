<?php namespace Controllers; 
    
    use Database\TicketDAO as TicketDAO;

    class CartController{

        private $ticketDAO;

        public function __construct(){
            $this->ticketDAO = new TicketDAO();
        }

        public function AddTicket($arrOfTickets){
            $this->ticketDAO->Add($arrOfTickets);
        }
        public function ShowCart(){
            require_once(VIEWS_PATH.'listCart.php');
        }
    }

?>