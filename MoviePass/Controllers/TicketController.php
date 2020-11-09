<?php namespace Controllers; 
    
    use Database\TicketDAO as TicketDAO;

    class TicketController{
        
        private $ticketDAO;

        public function __construct(){
            $this->ticketDAO = new TicketDAO();
        }

        #Sube el ticket a la base de datos
        public function AddTicket(){

        }
    }

?>