<?php

class Order
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
        $query = $this -> connexion -> prepare("SELECT id_event, `artist`, DATE_FORMAT(date, '%d %M %Y') AS date, `poster`,`name`,`category`, description, DATE_FORMAT(time, '%Hh%i') AS time FROM `events` WHERE id_event = ?");
        $query -> execute([$id]);
        $event = $query -> fetch();
        return $event;
    }

    public function getTicketsFromEvent($id)
    {
        $query = $this -> connexion -> prepare("SELECT name, price, description, id_price FROM tickets WHERE id_event = ? AND remaining_stock > 0");
        $query -> execute([$id]);
        $tickets = $query -> fetchAll();
        return $tickets;
    }

    public function addOrder($id_user, $date, $payment)
    {
        $query = $this -> connexion -> prepare("INSERT INTO orders (id_user, date, payment) VALUES (?, ?, ?)");
        $order = $query -> execute([$id_user, $date, $payment]);
        
        $id_order = $this -> connexion -> lastInsertId();
        
        return $id_order;
    }

    public function addDetailsOrder($id_order, $id_event, $cat_name, $quantity, $prices, $id_cat)
    {
        $query = $this -> connexion -> prepare("INSERT INTO details_order (id_order, id_event, cat_name, quantity, prices, id_cat) VALUES (?, ?, ?, ?, ?, ?)");
        $details = $query -> execute([$id_order, $id_event, $cat_name, $quantity, $prices, $id_cat]);
        return $details;
    }

    public function updateStock($substract, $add, $id)
    {
        $query = $this -> connexion -> prepare("UPDATE tickets SET remaining_stock = remaining_stock - ?, sold_stock = sold_stock + ? WHERE id_price = ?");
        $update = $query -> execute([$substract, $add, $id]);
        return $update;
    }

    public function getOrdersByUser($id)
    {
        $query = $this -> connexion -> prepare("SELECT id_order, id_user, DATE_FORMAT(date, '%d %M %Y à %Hh%i') AS date, payment FROM orders WHERE id_user = ?");
        $query -> execute([$id]);
        $order = $query -> fetchAll();
        return $order;
    }

    public function getOrderById($id)
    {
        $query = $this -> connexion -> prepare("SELECT id_order, id_user, DATE_FORMAT(date, '%d %M %Y à %Hh%i') AS date, payment FROM orders WHERE id_order = ?");
        $query -> execute([$id]);
        $order = $query -> fetch();
        return $order;
    }

    public function getDetailOrder($id)
    {
        $query = $this -> connexion -> prepare("SELECT orders.payment, orders.date, details_order.cat_name, details_order.quantity, details_order.prices, events.artist, events.poster, events.id_event AS id_event, DATE_FORMAT(events.date, '%d %M %Y') AS date, events.category, events.name, DATE_FORMAT(events.time, '%Hh%i') AS time
        FROM orders 
        INNER JOIN details_order ON orders.id_order = details_order.id_order 
        INNER JOIN events ON details_order.id_event = events.id_event 
        WHERE orders.id_order = ?");
        $query -> execute([$id]);
        $order = $query -> fetchAll();
        return $order;
    }

    public function getOrders()
    {
        $query = $this -> connexion -> prepare("SELECT id_order, id_user, DATE_FORMAT(date, '%d %M %Y à %Hh%i') AS date, payment FROM orders ORDER BY date ASC");
        $query -> execute();
        $orders = $query -> fetchAll();
        return $orders;
    }

    public function getDetailsByOrder($id)
    {
        $query = $this -> connexion -> prepare("SELECT id_event, id_cat, cat_name, quantity, prices FROM details_order WHERE id_order = ?");
        $query -> execute([$id]);
        $details = $query -> fetchAll();
        return $details;
    }

    public function getUserByOrder($id)
    {
        $query = $this -> connexion -> prepare("SELECT users.id_user, lastname, name, email, adress, postcode, city, country, phone FROM users INNER JOIN orders ON users.id_user = orders.id_user WHERE id_order = ?");
        $query -> execute([$id]);
        $user = $query -> fetch();
        return $user;
    }

    public function getNextEvent($id)
    {
        $query = $this -> connexion -> prepare("SELECT events.id_event AS id_event, events.artist AS artist, events.date AS date, DATE_FORMAT(events.date, '%y') AS annee, DATE_FORMAT(events.date, '%m') AS mois, DATE_FORMAT(events.date, '%d') AS jour, events.poster AS poster, events.name AS name, events.category AS category
        FROM orders 
        INNER JOIN details_order ON orders.id_order = details_order.id_order 
        INNER JOIN events ON details_order.id_event = events.id_event 
        WHERE id_user = ? AND events.date > NOW() 
        ORDER BY events.date ASC LIMIT 1");
        $query -> execute([$id]);
        $event = $query -> fetch();
        return $event;
    }

    public function getLastSells()
    {
        $query = $this -> connexion -> prepare("SELECT COUNT(*) AS number FROM orders");
        $query -> execute();
        $number = $query -> fetch();
        return $number;
    }

}