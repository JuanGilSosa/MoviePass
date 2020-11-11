<?php namespace Models\Shopping;

    class Cart{
        
        private $tickets;
        private $countTicket;
        #private $member; #o idMember

        public function __construct(/*$member*/){
            $this->tickets = array();
            $this->countTicket = 0;
            #$this->member = $member;
        }

        #public function SetMember($member){$this->member = $member;}
        #public function GetMember(){return $this->member;}
        public function SetTickets($tickets){$this->tickets = $tickets;}
        public function GetTickets(){return $this->tickets;}
        public function GetCountTicket(){return $this->countTicket;}
        public function PushTicket($ticket){
            array_push($this->tickets, $ticket);
            $this->countTicket+=1;
        }
        public function GetTicketsSimil(){
            foreach($this->tickets as $index=>$ticket){
                if(isset($this->tickets[$index+1])){
                    $nextTicket = $this->tickets[$index+1];
                }
                if($ticket){

                }
            }
        }
    
    }
?>