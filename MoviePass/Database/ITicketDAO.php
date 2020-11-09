<?php namespace Database;
    interface ITicketDAO{
        function GetAll();
        function Add(Ticket $ticket);
        function Delete($ticketId);
        function Update(Ticket $ticket);
        function mapping($value);
    }
?>