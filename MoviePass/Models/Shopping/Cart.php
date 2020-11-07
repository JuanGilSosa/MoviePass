<?php namespace Models\Shopping;

    class Cart{
        
        private $tickets;
        private $member; #o idMember

        public function __construct($member){
            $this->tickets = array();
            $this->member = $member;
        }

        public function SetMember($member){$this->member = $member;}
        public function SetTickets($tickets){$this->tickets = $tickets;}
        public function GetMember(){return $this->member;}
        public function GetTickets(){return $this->tickets;}
        public function PushTickets($ticket){array_push($this->tickets, $ticket);}
    }
?>