<?php namespace Models\Shopping;

    class Ticket{

        private $numberTicket;
        private $showTime;

        public function __construct($numberTicket, $showTime){
            $this->numberTicket = $numberTicket;
            $this->showTime = $showTime;
        }
        public function SetNumberTicket($numberTicket){$this->numberTicket = $numberTicket;}
        public function SetShowtime($showTime){$this->showTime = $showTime;}
        public function GetShowtime(){return $this->showTime;}
        public function GetNumberTicket(){return $this->numberTicket;}
        
    }

?>