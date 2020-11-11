<?php namespace Database;

    use Models\Shopping\Ticket as Ticket;

    use PDOException as PDOException;

    class TicketDAO implements ITicketDAO{

        function GetAll(){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT * FROM tickets;';
                $tickets = $con->execute($query); 
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
                return new Ticket($p['numberTicket'],$p['showtimeId'],$p['numbersOfTickets']);
            },$value);
            return (count($ans)>1) ? $ans : $ans[0];
        }

        function GetTicketByIdMember($idMember){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT t.* 
                            FROM tickets as t 
                            INNER JOIN ticketxmember as txm 
                                ON t.numberTicket = txm.numberTicket 
                                    AND txm.idMember = :idMember;';
                $params['idMember'] = $idMember;
                $tickets = $con->execute($query, $params);
                return (!empty($tickets)) ? $this->mapping($tickets) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        function Add_ticketxmember($idMember, $numberTicket){
            try {
                $con = Connection::getInstance();
                $query = 'INSERT INTO ticketxmember(idMember,numberTicket)VALUES(:idMember,:numberTicket);';
                $params['numberTicket'] = $numberTicket;
                $params['idMember'] = $idMember;
                return $con->executeNonQuery($query, $params);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        function GetLastId(){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT max(numberTicket) FROM tickets;';
                $tickets = $con->execute($query); 
                return (!empty($tickets)) ? intval($tickets[0][0]) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        function GetCountTickets(){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT sum(numbersOfTickets) FROM tickets;';
                $tickets = $con->execute($query); 
                return (!empty($tickets)) ? intval($tickets[0][0]) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        function GetTicketByIdShowtime($idShowtime){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT sum(numbersOfTickets) FROM tickets as t WHERE t.showtimeId = :showtimeId';
                $params['showtimeId'] = $idShowtime;
                $countTickets = $con->execute($query, $params); 
                return (!empty($countTickets)) ? $countTickets[0][0] : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

    }
?>