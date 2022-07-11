<?php

require "models/Order.php";

class OrderController
{
    private $order;
    private $userController;
    private $admin;

    public function __construct()
    {
        $this -> order = new Order();
        $this -> userController = new UserController();
        $this -> admin = new AdminController();
    }

    public function showPrices() // montrer les prix disponibles dans fiche concert
    {
        if(array_key_exists("id", $_GET))
        {
            $event = $this -> order -> getEventById($_GET["id"]); // récupération des évènements selon l'id dans l'url

            $tickets = $this -> order -> getTicketsFromEvent($_GET["id"]); // récupération des billets et tarifs selon l'id de l'évènement

            if(!$tickets) // si pas de billet récupéré, pas de stock
            {
                $message = "Plus de stock disponible pour cet évènement.";
            }
        }
        $titre = "Tarifs ".$event['name'];
        $template = "tickets/prices";
        require "www/layout.phtml";
    }

    public function basket() // affichage du panier
    {
        $titre = "Panier";
        $template = "order/basket";
        require "www/layout.phtml";
    }

    public function sendOrder() // valider la commande
    {
        if(array_key_exists("order",$_GET) && array_key_exists("total",$_GET))
        {
            $orders = $_GET["order"];
            $orders = json_decode($orders);
            $payment = floatval($_GET["total"]);

            $id_user = $_SESSION["user"]["id_user"];

            $date = date('y-m-d h:i:s');

            $id_order = $this -> order -> addOrder($id_user, $date, $payment); // création de la commande dans la bdd

            foreach($orders as $order)
            {
                // envoi des détails de la commande dans la bdd + mise à jour des stocks
                $test = $this -> order -> addDetailsOrder($id_order, $order[7], $order[1], $order[0], $order[3], $order[4]);
                $stock = $this -> order -> updateStock($order[0], $order[0], $order[4]);
            }
        }
    }

    public function detailOrder() // afficher les détails d'une commande
    {
        if($this -> userController -> is_connected())
        {
            $titre = "Détails de ma commande";
            $template = "user/detailOrder";

            if(array_key_exists("idOrder", $_GET))
            {
                $id = $_GET["idOrder"];

                // récupérer la commande et ses détails en fonction de l'id dans l'url
                $order = $this -> order -> getOrderById($id);
                $tickets = $this -> order -> getDetailOrder($id);
            }
            require "www/layout.phtml";
        }
        else
        {
            header("Location:index.php");
        }
    }

    public function showAllOrders() // montrer toutes les commandes effectuées
    {
        if($this -> admin -> admin_connected())
        {
            $titre = "Commandes";
            $template = "admin/adminOrders";

            $orders = $this -> order -> getOrders(); // toutes les commandes

            if(array_key_exists("id", $_GET))
            {
                $titre = "Détails de la commande";
                
                $id = $_GET["id"];
                $orderById = $this -> order -> getOrderById($id);
                $user = $this -> order -> getUserByOrder($id); // données de l'utilisateur ayant effectué la commande selon l'id dans l'url
                $details = $this -> order -> getDetailOrder($id); // détails de la commande effectuée selon l'id dans l'url 
            }

            require "www/layoutAdmin.phtml";
        }
        else
        {
            header("Location:index.php");
        }
    }
}

