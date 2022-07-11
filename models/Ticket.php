<?php

class Ticket
{
    private $database;
    private $connexion;

    public function __construct()
    {
        $this -> database = new Database();
        $this -> connexion = $this -> database -> getConnexion();
    }

    public function getEventById($id)
    {
        $query = $this -> connexion -> prepare("SELECT id_event, `artist`, DATE_FORMAT(date, '%d %M %Y') AS date,`poster`,`name`,`category`, description, time, video FROM `events` WHERE id_event = ?");
        $query -> execute([$id]);
        $event = $query -> fetch();
        return $event;
    }

    public function getTicketsByEvent($id)
    {
        $query = $this -> connexion -> prepare("SELECT id_price, id_event, name, price, original_stock, remaining_stock, sold_stock, description FROM tickets WHERE id_event = ?");
        $query -> execute([$id]);
        $tickets = $query -> fetchAll();
        return $tickets;
    }
    
    public function getTicketsById($id)
    {
        $query = $this -> connexion -> prepare("SELECT id_price, id_event, name, price, original_stock, remaining_stock, sold_stock, description FROM tickets WHERE id_price = ?");
        $query -> execute([$id]);
        $tickets = $query -> fetch();
        return $tickets;
    }

    public function deleteTicket($id)
    {
        $query = $this -> connexion -> prepare("DELETE FROM tickets WHERE id_price = ?");
        $delete = $query -> execute([$id]);
        return $delete;
    }

    public function modifyTicket($name, $description, $price, $original, $remaining, $sold, $idTicket)
    {
        $query = $this -> connexion -> prepare("UPDATE tickets SET name = ?, description = ?, price = ?, original_stock = ?, remaining_stock = ?, sold_stock = ? WHERE id_price = ?");
        $modified = $query -> execute([$name, $description, $price, $original, $remaining, $sold, $idTicket]);
        return $modified;
    }

    public function addTicket($id_event, $name, $price, $original, $remaining, $sold, $description)
    {
        $query = $this -> connexion -> prepare("INSERT INTO tickets (id_event, name, price, original_stock, remaining_stock, sold_stock, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $added = $query -> execute([$id_event, $name, $price, $original, $remaining, $sold, $description]);
        return $added;
    }
}