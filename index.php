<?php

session_start();

require "config/Database.php";
require "controllers/EventController.php";
require "controllers/TicketController.php";
require "controllers/UserController.php";
require "controllers/OrderController.php";
require "controllers/AdminController.php";

$eventController = new EventController();
$ticketController = new TicketController();
$userController = new UserController();
$orderController = new OrderController();
$adminController = new AdminController();

if(array_key_exists("action", $_GET))
{
    switch($_GET["action"])
    {
        // billetterie 
        case "tickets" :
            // affichage des différents filtres de recherche disponibles
            $eventController -> cmdAjaxFilters();
            break;
        // choix de filtre dans la billeterie
        case "showBy" :
            // utilisation du filtre choisi
            $eventController -> cmdAjaxFilters();
            break;
        // clique sur un concert
        case "event" :
            $ticketController -> event();
            break;
        // panier
        case "basket" :
            $orderController -> basket();
            break;
        // rejoindre la newsleter
        case "join_newsletter" :
            $userController -> addNewsletter();
            break;
        // voir les tarifs dans la fiche concert
        case "showPrices" :
            $orderController -> showPrices();
            break;
        // se connecter
        case "login" :
            $userController -> connect();
            break;
        // créer un compte
        case "register" :
            $userController -> register();
            break;
        // clique sur compte
        case "account" :
            $userController -> userAccount();
            break;
        // modifier le compte
        case "modifyAccount" :
            $userController -> modifyAccount();
            break;
        // se déconnecter
        case "disconnect" :
            $userController -> disconnet();
            break;
        // modifier le mot de passe utilisateur
        case "modifyPassword" :
            $userController -> modifyPassword();
            break;
        // supprimer le compte utilisateur
        case "deleteUser" :
            $userController -> deleteUser();
            break;
        // modifier son choix de newsletter utilisateur
        case "changeNewsletter" :
            $userController -> changeNewsletter();
            break;
        // valider le panier
        case "sendOrder" :
            $orderController -> sendOrder();
            break;
        // détail de la commande dans la liste des commandes de l'utilisateur
        case "detailOrder" :
            $orderController -> detailOrder();
            break;
        // accès panneau d'administration
        case "admin" :
            $adminController -> admin();
            break;
        // gestion des concerts côté Admin
        case "adminEvents" :
            $eventController -> adminEvents();
            break;
        // barre de recherche
        case "searchBar" :
            $eventController -> searchBar();
            break;
        // supprimer concert côté admin
        case "eventSupp" :
            $eventController -> eventSupp();
            break;
        // modifier concert côté admin
        case "eventModif" :
            $eventController -> eventModif();
            break;
        // ajouter concert côté admin
        case "addEvent" : 
            $eventController -> addEvent();
            break;
        // gestion slider côté admin
        case "adminSlider" :
            $eventController -> sliderList();
            break;
        // gestion des billets/tickets côté admin
        case "adminTickets" :
            $ticketController -> eventList();
            break;
        // visualisation des commandes côté admin
        case "adminOrders" :
            $orderController -> showAllOrders();
            break;
        // visualisation des utilisateurs côté admin
        case "adminUsers" :
            $userController -> showAllUsers();
            break;
        // visualisation et ajout de catégories côté admin
        case "adminCategories" :
            $eventController -> showAllCategories();
            break;
        // visualisation des messages côté admin
        case "adminMessages" :
            $userController -> showMessages();
            break;
        // supprimer un message admin
        case "suppMessage" :
            $userController -> suppMessage();
            break;
        // page infos pratiques
        case "practical" :
            $userController -> practical();
            break;
        // page contact
        case "contact" : 
            $userController -> contact();
            break;
        // page contact
        case "modifyAdmin" : 
            $adminController -> modify();
            break;
    }
}
else
{
    // page principale, avec slider, newsletter et concerts à l'affiche
    $eventController -> home();
}