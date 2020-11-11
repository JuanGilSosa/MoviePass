<?php namespace Models\Shopping;

    class Ticket{

        private $numberTicket;
        private $showTime;
        private $numbersOfTickets;

        public function __construct($numberTicket, $showTime){
            $this->numberTicket = $numberTicket;
            $this->showTime = $showTime;
            $this->numbersOfTickets = 1;
        }
        public function SetNumberTicket($numberTicket){$this->numberTicket = $numberTicket;}
        public function SetShowtime($showTime){$this->showTime = $showTime;}
        public function GetShowtime(){return $this->showTime;}
        public function GetNumberTicket(){return $this->numberTicket;}

        public function SetNumberOfTickets(){
            $this->numbersOfTickets+=1;
        }
        public function GetNumberOfTickets(){
            return $this->numbersOfTickets;
        }
    }

?>