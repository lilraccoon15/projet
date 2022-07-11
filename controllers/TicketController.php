<?php

require "models/Ticket.php";

class TicketController
{
    private $ticket;
    private $admin;
    private $events;

    public function __construct()
    {
        $this -> ticket = new Ticket();
        $this -> admin = new AdminController();
        $this -> events = new Event();
    }

    public function event() // affichage du concert selon l'id dans l'url
    {
        if(array_key_exists("id", $_GET))
        {
            $event = $this -> ticket -> getEventById($_GET["id"]);
        }
        $titre = $event['name'];
        $template = "tickets/event";

        require "www/layout.phtml";
    }

    public function eventList() // affichage de la liste des concerts dans l'espace admin
    {
        if($this -> admin -> admin_connected())
        {
            $titre = "Gestion des tarifs";
            $template = "admin/eventTicketList";

            $events = $this -> events -> getAllEvents(); // on récupère tous les concerts dans la bdd

            if(array_key_exists("id", $_GET)) // si je clique sur un concert 
            {
                $id = $_GET["id"];
                $tickets = $this -> ticket -> getTicketsByEvent($id); // récupération des tarifs selon l'id du concert dans l'url
                $ticketsByEvent = $this -> events -> getEventById($id); // récupération des infos du concert selon l'id 
            }
            elseif(array_key_exists("suppTicket", $_GET) && array_key_exists("idTicket",$_GET)) // si je clique sur supprimer un ticket
            {
                // supprimer le billet
                $idTicket = $_GET["idTicket"];
                $delete = $this -> ticket -> deleteTicket($idTicket); // on supprime le ticket selon l'id dans la bdd
            }
            elseif(array_key_exists("changeTicket",$_GET) && array_key_exists("idTicket",$_GET)) // si je clique sur modifier un ticket
            {
                $titre = "Modification du tarif";
                $idTicket = $_GET["idTicket"];
                $ticket = $this -> ticket -> getTicketsById($idTicket); // on récupère les infos du ticket selon son id
                // modifier le billet
                if(isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["original"]) && isset($_POST["remaining"]) && isset($_POST["sold"]))
                {
                    if(!empty($_POST["name"]) && !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["original"]))
                    {
                        $id_event = htmlspecialchars($_POST["id_event"]);
                        $name = htmlspecialchars($_POST["name"]);
                        $description = htmlspecialchars($_POST["description"]);
                        $price = htmlspecialchars($_POST["price"]);
                        $original = htmlspecialchars($_POST["original"]);
                        $remaining = htmlspecialchars($_POST["remaining"]);
                        $sold = htmlspecialchars($_POST["sold"]);

                        $modify = $this -> ticket -> modifyTicket($name, $description, $price, $original, $remaining, $sold, $idTicket); // modification du billet selon le formulaire

                        if($modify)
                        {
                            $message = "Le billet a bien été modifié.";
                            header("Location:index.php?action=adminTickets&id=".$id_event."&message=".$message);
                        }
                        else
                        {
                            $message = "Une erreur SQL est survenue.";
                        }
                    }
                    else
                    {
                        $message = "Le formulaire n'a pas été correctement rempli.";
                    }
                }
            }
            elseif(array_key_exists("addTicket", $_GET) && array_key_exists("idEvent", $_GET)) // si on clique sur ajouter ticket
            {
                $titre = "Ajouter un tarif";

                $id_event = $_GET["idEvent"];
                $ticketsByEvent = $this -> events -> getEventById($id_event); // récupérer les infos du concert
                // ajouter un billet
                if(isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["original"]) && isset($_POST["remaining"]) && isset($_POST["sold"]))
                {
                    if(!empty($_POST["name"]) && !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["original"]))
                    {
                        $name = htmlspecialchars($_POST["name"]);
                        $description = htmlspecialchars($_POST["description"]);
                        $price = htmlspecialchars($_POST["price"]);
                        $original = htmlspecialchars($_POST["original"]);
                        $remaining = htmlspecialchars($_POST["remaining"]);
                        $sold = htmlspecialchars($_POST["sold"]);

                        $add = $this -> ticket -> addTicket($id_event, $name, $price, $original, $remaining, $sold, $description); // ajout du tarif dans la bdd

                        if($add)
                        {
                            $message = "Le billet a bien été ajouté.";
                            header("Location:index.php?action=adminTickets&id=".$id_event."&message=".$message);
                        }
                        else
                        {
                            $message = "Une erreur SQL est survenue.";
                        }
                    }
                    else
                    {
                        $message = "Le formulaire n'a pas été correctement rempli.";
                    }
                }
            }
            require "www/layoutAdmin.phtml";
        }
        else
        {
            header("Location:index.php");
        }
    }
}