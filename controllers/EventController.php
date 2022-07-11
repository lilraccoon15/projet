<?php

require "models/Event.php";

class EventController
{
    private $events;
    private $admin;

    public function __construct()
    {
        $this -> events = new Event();
        $this -> admin = new AdminController();
    }

    public function home() // page d'accueil
    {
        $slides = $this -> events -> getSlider(); // affichage du slider selon la bdd sur la page d'accueil
        $highlights = $this -> events -> getHighlights(); // affichage des concerts à l'affiche selon la bdd sur la page d'accueil

        $titre = "Radioactive";
        $template = "home";
        require "www/layout.phtml";
    }

    public function cmdAjaxFilters() // si on filtre la billetterie 
    {
        if(array_key_exists("price", $_GET)) // si on choisi de filtrer par prix
        {
            $price = (string)$_GET["price"];
            $events = $this -> events -> getEventByPrice($price); // récupération des concerts dans la bdd selon le prix
            echo json_encode($events); 
        }
        elseif(array_key_exists("date", $_GET)) // si on filtre par date
        {
            $date = (string)$_GET["date"];
            $events = $this -> events -> getEventByDate($date); // récupération selon la date
            echo json_encode($events);
        }
        elseif(array_key_exists("artist", $_GET)) // si on filtre par artiste
        {
            $events = $this -> events -> getEventByArtist($_GET["artist"]); // récupération selon l'artiste
            echo json_encode($events);
        }
        elseif(array_key_exists("cat", $_GET)) // si on filtre par catégorie musicale
        {
            $events = $this -> events -> getEventByCategory($_GET["cat"]); // récupération selon catégorie
            echo json_encode($events);
        }
        else // si on filtre pas la billetterie
        {
            $cats = $this -> events -> getCategories(); // on récupère les catégories pour les boucler pour les filtres
            $artists = $this -> events -> getArtists(); // on récupère les artistes pour les boucler pour les filtres

            $events = $this -> events -> getEvents(); // on affiche tous les concerts n'ayant pas encore eu lieu
            
            $titre = "Billetterie";
            $template = "tickets/tickets";
            require "www/layout.phtml";
        }
    }

    public function adminEvents()
    {
        if($this -> admin -> admin_connected())
        {
            $titre = "Liste des évènements";
            $template = "admin/adminEvents";

            $events = $this -> events -> getAllEvents(); // affichage de tous les concerts (même passés)

            require "www/layoutAdmin.phtml";
        }
        else
        {
            header("Location:index.php");
        }
    }

    public function addEvent() // ajouter un concert
    {
        if($this -> admin -> admin_connected())
        {
            $titre = "Ajouter un évènement";
            $template = "admin/addEvent";

            $cats = $this -> events -> getCategories(); // récupération des catégories pour les boucler dans le select du formulaire

            if(isset($_POST["artist"]) && isset($_POST["tourName"]) && isset($_POST["category"]) && isset($_POST["description"]) && isset($_POST["date"]) && isset($_POST["time"]) && isset($_FILES["poster"]) && isset($_POST["price"]))
            {
                if(!empty($_POST["artist"]) && !empty($_POST["tourName"]) && !empty($_POST["category"]) && !empty($_POST["description"]) && !empty($_POST["date"]) && !empty($_POST["time"]) && !empty($_FILES["poster"]["name"]) && !empty($_POST["price"]))
                {
                    $artist = htmlspecialchars($_POST["artist"]);
                    $name = htmlspecialchars($_POST["tourName"]);
                    $category = htmlspecialchars($_POST["category"]);
                    $description = htmlspecialchars($_POST["description"]);
                    $date = htmlspecialchars($_POST["date"]);
                    $time = htmlspecialchars($_POST["time"]);
                    $poster = $_FILES["poster"]["name"];
                    $price = htmlspecialchars($_POST["price"]);

                    // ajout du poster dans le dossier images/posters
                    $uploads_dir_poster = "www/images/posters";
                    $tmp_name_poster = $_FILES["poster"]["tmp_name"];
                    $poster_name = $_FILES["poster"]["name"];
                    $poster_size = $_FILES["poster"]["size"];
                    $poster_ext = strtolower(end(explode(".",$_FILES["poster"]["name"])));
                    $extensions = array("jpeg", "jpg", "png");
                    $max_size = 2000000;

                    if(in_array($poster_ext, $extensions) && ($poster_size < $max_size)) // si le format est bon
                    {
                        move_uploaded_file($tmp_name_poster, "$uploads_dir_poster/$poster_name"); // on ajoute l'image dans le dossier
                        if(isset($_FILES["banner"]["name"]) && !empty($_FILES["banner"]["name"])) // si on a renseigné une bannière pour le slider
                        {
                            $banner = $_FILES["banner"]["name"];
                            $uploads_dir_banner = "www/images/banners";
                            $tmp_name_banner = $_FILES["banner"]["tmp_name"];
                            $banner_name = $_FILES["banner"]["name"];
                            $banner_size = $_FILES["banner"]["size"];
                            $banner_ext = strtolower(end(explode(".",$_FILES["banner"]["name"])));

                            $slider = "yes";
                            if(in_array($banner_ext, $extensions) && ($banner_size < $max_size))
                            {
                                move_uploaded_file($tmp_name_banner, "$uploads_dir_banner/$banner_name"); // on ajoute la bannière dans le dossier

                                $addEvent = $this -> events -> addEventWithBanner($artist, $date, $category, $poster, $name, $description, $slider, $time, $price, $banner); // ajout de l'event avec bannière dans bdd
                                
                                // vérifier si l'artiste existe
                                $artistName = $this -> events -> getArtistByName($artist);
                                if(!$artistName)
                                {
                                    // s'il n'existe pas, ajouter l'artiste
                                    $addArtist = $this -> events -> addArtist($artist);
                                }
                            }
                        }
                        else // si on a pas renseigné de bannière pour le slider
                        {
                            $addEvent = $this -> events -> addEvent($artist, $date, $category, $poster, $name, $description, $time, $price); // on ajoute le concert sans bannière 
                        
                            // vérifier si l'artiste existe
                            $artistName = $this -> events -> getArtistByName($artist);
                            if(!$artistName)
                            {
                                // s'il n'existe pas, ajouter l'artiste
                                $addArtist = $this -> events -> addArtist($artist);
                            }
                        }
                    }
                    else 
                    {
                        $message = "Taille ou format du fichier incorrect.";
                    }

                    if($addEvent) // si l'évènement a bien été ajouté à la bdd, on redirige, sinon on affiche une erreur
                    {
                        $message = "Le nouvel évènement a bien été ajouté !";
                        header("Location:index.php?action=adminEvents&message=".$message);
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
            require "www/layoutAdmin.phtml";
        }
        else
        {
            header("Location:index.php");
        }
    }

    public function searchBar() // barre de recherche
    {
        if(array_key_exists("result", $_GET))
        {
            $entry = htmlspecialchars($_GET["result"]); // récupération js de la saisie
            // var_dump($artist);
            $searchs = $this -> events -> getElementsForSearchBar($entry); // comparaison de la saisie à la bdd
            // var_dump($searchs);
            foreach ($searchs as $search) // si il y a résultat, on affiche les résultats
            {
                ?>
                    <li><a href="index.php?action=event&id=<?= $search['id_event'] ?>"><?= $search["artist"] ?></a></li>
                <?php 
            }   
        }   
    }

    public function eventSupp() // suppression d'un concert du côté admin
    {
        if($this -> admin -> admin_connected())
        {
            if(array_key_exists("id", $_GET)) // suppression en fonction de l'id du concert
            {
                $id = $_GET["id"];
                $event = $this -> events -> getEventById($id); // récupération du concert selon l'id dans l'url

                $poster = $event["poster"];
                $banner = $event["banner"];

                $uploads_dir_poster = "www/images/posters/".$poster;
                $uploads_dir_banner = "www/images/banners/".$banner;

                //suppression des images dans les dossiers
                $suppPoster = unlink($uploads_dir_poster);
                $suppBanner = unlink($uploads_dir_banner);

                $supp = $this -> events -> suppressEvent($id); // suppression du concert

                if($supp)
                {
                    $message = "L'évènement a bien été supprimé.";
                    header("Location:index.php?action=adminEvents&message=".$message);
                }
            }
        }
        else
        {
            header("Location:index.php");
        }
    }

    public function eventModif() // modification d'un concert dans coin admin
    {
        if($this -> admin -> admin_connected())
        {
            if(array_key_exists("id", $_GET)) // récupération de l'id du concert dans l'url
            {
                $titre = "Modifier un évènement";
                $template = "admin/modifEvent";

                $id = $_GET["id"];
                $event = $this -> events -> getEventById($id); // récupérer le concert selon son id afin de pré remplir le formulaire
                $cats = $this -> events -> getCategories(); // affichage des catégories dans le select

                if(!empty($_POST))
                {
                    if(isset($_POST["artist"]) && isset($_POST["tourName"]) && isset($_POST["category"]) && isset($_POST["description"]) && isset($_POST["date"]) && isset($_POST["time"]) && isset($_FILES["poster"]) && isset($_POST["price"]))
                    {
                        if(!empty($_POST["artist"]) && !empty($_POST["tourName"]) && !empty($_POST["category"]) && !empty($_POST["description"]) && !empty($_POST["date"]) && !empty($_POST["time"]) && !empty($_POST["price"]))
                        {
                            $artist = htmlspecialchars($_POST["artist"]);
                            $name = htmlspecialchars($_POST["tourName"]);
                            $category = htmlspecialchars($_POST["category"]);
                            $description = htmlspecialchars($_POST["description"]);
                            $date = htmlspecialchars($_POST["date"]);
                            $time = htmlspecialchars($_POST["time"]);
                            $posterSet = htmlspecialchars($_POST["posterSet"]);
                            $price = htmlspecialchars($_POST["price"]);

                            // si le poster est renseigné
                            if(!empty($_FILES["poster"]["name"]))
                            {
                                $uploads_direction = "www/images/posters/".$posterSet;
                                // supprimer l'ancien poster
                                $supp = unlink($uploads_direction);
                                // upload le nouveau 
                                $uploads_dir_poster = "www/images/posters";
                                $tmp_name_poster = $_FILES["poster"]["tmp_name"];
                                $poster_name = $_FILES["poster"]["name"];
                                move_uploaded_file($tmp_name_poster, "$uploads_dir_poster/$poster_name");

                                $editEvent = $this -> events -> editEventWithPoster($artist, $date, $category, $name, $description, $time, $price, $poster_name, $id); // modifier le concert avec le poster
                            }
                            else
                            {
                                // on modifie le concert sans toucher au poster
                                $editEvent = $this -> events -> editEvent($artist, $date, $category, $name, $description, $time, $price, $id);
                            }

                            if($editEvent)
                            {
                                $message = "L'évènement a bien été modifié.";
                                header("Location:index.php?action=adminEvents&message=".$message);
                            }
                            else
                            {
                                $message = "Une erreur SQL est survenue !";
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
        }
        else
        {
            header("Location:index.php");
        }
    }

    public function sliderList() // modifier le slider
    {
        if($this -> admin -> admin_connected())
        {
            $titre = "Modifier le slider";
            $template = "admin/sliderList";

            $events = $this -> events -> getAllEvents(); // afficher tous les concerts

            if(array_key_exists("id", $_GET))
            {
                $id = $_GET["id"];
                $info = $this -> events -> getEventById($id); // récupération du concert selon l'id
                // var_dump($info["banner"]);
                if(array_key_exists("suppSlider", $_GET)) // si on clique sur supprimer
                {
                    $banner = $info["banner"];
                    $uploads_direction = "www/images/banners/".$banner;
                    // supprimer l'ancien poster
                    $supp = unlink($uploads_direction);
                    $newBanner = "";
                    $on_slider = "";

                    $modify = $this -> events -> changeSlider($newBanner, $on_slider, $id); // modification dans la bdd

                    if($modify)
                    {
                        $message = "Le slider a bien été modifié.";
                        header("Location:index.php?action=adminSlider&message=".$message);
                    }
                    else
                    {
                        $message = "Une erreur SQL est survenue !";
                    }
                }
                elseif(array_key_exists("changeSlider", $_GET)) // si on clique sur modifier
                {
                    if(isset($_FILES["banner"]))
                    {
                        if(!empty($_FILES["banner"])) // il faut renseigner la nouvelle bannière
                        {
                            $banner = $info["banner"];
                            $uploads_direction = "www/images/banners/".$banner;
                            // supprimer l'ancien poster
                            $supp = unlink($uploads_direction);

                            $uploads_dir_banner = "www/images/banners";
                            $tmp_name_banner = $_FILES["banner"]["tmp_name"];
                            $newBanner = $_FILES["banner"]["name"];
                            // ajouter la nouvelle bannière
                            move_uploaded_file($tmp_name_banner, "$uploads_dir_banner/$newBanner");
                            $on_slider = "yes";

                            $modify = $this -> events -> changeSlider($newBanner, $on_slider, $id); // modificaiton dans la bdd

                            if($modify)
                            {
                                $message = "Le slider a bien été modifié.";
                                header("Location:index.php?action=adminSlider&message=".$message);
                            }
                            else
                            {
                                $message = "Une erreur SQL est survenue !";
                            }
                        }
                        else
                        {
                            $message = "Le formulaire n'a pas été correctement rempli.";
                        }
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

    public function on_slider() // si event sur slider, on affiche l'ajout, sinon la suppression
    {
        if(array_key_exists("id", $_GET))
        {
            $id = $_GET["id"];

            $slider = $this -> events -> getEventsFromSlider($id); // récupération des concerts sur slider en fonction de l'id

            if($slider)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    public function showAllCategories() // affichage des catégories dans l'espace adminS
    {
        if($this -> admin -> admin_connected())
        {
            $titre = "Catégories";
            $template = "admin/adminCategories";

            $categories = $this -> events -> getCategories();

            if(array_key_exists("add", $_GET)) // si on clique sur ajouter une catégorie
            {
                $titre = "Ajouter une catégorie";
                
                if(isset($_POST["cat_name"]))
                {
                    if(!empty($_POST["cat_name"]))
                    {
                        $cat_name = htmlspecialchars($_POST["cat_name"]);

                        $existing = $this -> events -> getCategoryByName($cat_name); // on vérifie qu'elle n'existe pas déjà
                        if(!$existing)
                        {
                            $create = $this -> events -> createCategory($cat_name); // on l'ajoute à la bdd

                            if($create)
                            {
                                $message = "La catégorie a bien été créée.";
                                header("Location:index.php?action=adminCategories&message=".$message);
                            }
                            else
                            {
                                $message = "Une erreur SQL est survenue !";
                            }
                        }
                        else
                        {
                            $message = "Cette catégorie existe déjà.";
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