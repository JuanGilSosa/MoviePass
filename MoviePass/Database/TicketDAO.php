<?php namespace Database;

    use Models\Shopping\Ticket as Ticket;

    class TicketDAO implements ITicketDAO{

        function GetAll(){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT * FROM tickets;';
                $tickets = $con->execute($query, $params); 
                return (!empty($tickets)) ? $this->mapping($tickets) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        function Add($ticket){
            try {
                $con = Connection::getInstance();
                $query = 'INSERT INTO tickets(numberTicket,showtimeId,numbersOfTickets)VALUES(:numberTicket,:showtimeId,:numbersOfTickets);';
                $params['numberTicket'] = $ticket->GetNumberTicket();
                $params['showtimeId'] = $ticket->GetShowtime()->GetId();
                $params['numbersOfTickets'] = $ticket->GetNumberOfTickets();
                return $con->executeNonQuery($query, $params);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        
        function Delete($ticketId){

        }
        
        function Update($ticket){

        }
        
        function mapping($value){
            $value = is_array($value) ? $value : [];
            $ans = array_map(function($p){
                $t =  new Ticket($p['numberTicket'],$p['showtimeId']);
                $t->SetNumberOfTickets(intval($p['numbersOfTickets']));
                return $t;
            },$value);
            return (count($ans)>1) ? $ans : $ans[0];
        }


    }
?>