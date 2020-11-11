<?php namespace Models\Shopping;

    class Ticket{

        private $numberTicket;
        private $showTime;
        private $numbersOfTickets;

        public function __construct($numberTicket, $showTime, $numbersOfTickets = 1){
            $this->numberTicket = $numberTicket;
            $this->showTime = $showTime;
            $this->numbersOfTickets = $numbersOfTickets;
        }

        public function SetNumberTicket($numberTicket){$this->numberTicket = $numberTicket;}
        public function SetShowtime($showTime){$this->showTime = $showTime;}
        public function GetShowtime(){return $this->showTime;}
        public function GetNumberTicket(){return $this->numberTicket;}

        public function GetNumberOfTickets(){
            return $this->numbersOfTickets;
        }

        public function IncrementNumberOfTickets(){
            $this->numbersOfTickets+=1;
        }

        public function SetAmountOfTickets($amountOfTickets){
            $this->numbersOfTickets = $amountOfTickets;
        }

    }

?>