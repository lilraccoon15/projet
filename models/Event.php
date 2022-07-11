<?php

class Event
{
    private $database;
    private $connexion;

    public function __construct()
    {
        $this -> database = new Database();
        $this -> connexion = $this -> database -> getConnexion();
    }

    // afficher les éléments du slider dans l'accueil
    public function getSlider()
    {
        $query = $this -> connexion -> prepare("SELECT id_event, artist, banner, date, name, YEAR(date) AS annee, DATE_FORMAT(date, '%M') AS mois, DATE_FORMAT(date, '%d') AS jour FROM events WHERE on_slider = 'yes' AND `date` > NOW()");
        $query -> execute();
        $slides = $query -> fetchAll();
        return $slides;
    }

    // récupérer les infos du concert sur slider en fonction de l'id du concert
    public function getEventsFromSlider($id)
    {
        $query = $this -> connexion -> prepare("SELECT id_event, artist, banner, date, name FROM events WHERE on_slider = 'yes' AND id_event = ? AND `date` > NOW()");
        $query -> execute([$id]);
        $slides = $query -> fetchAll();
        return $slides;
    }

    // afficher les concerts à la une dans l'accueil
    public function getHighlights()
    {
        $query = $this -> connexion -> prepare("SELECT id_event, `artist`, date, DATE_FORMAT(date, '%y') AS annee, DATE_FORMAT(date, '%m') AS mois, DATE_FORMAT(date, '%d') AS jour,`poster`,`name`,`category` FROM events WHERE `date` > NOW() ORDER BY date ASC LIMIT 10");
        $query -> execute();
        $highlights = $query -> fetchAll();
        return $highlights;
    }

    // afficher les filtres "artiste" dans la billetterie
    public function getArtists()
    {
        $query = $this -> connexion -> prepare("SELECT artist FROM events");
        $query -> execute();
        $events = $query -> fetchAll();
        return $events;
    }

    // récupérer les artistes en fonction de leur nom
    public function getArtistByName($name)
    {
        $query = $this -> connexion -> prepare("SELECT name FROM artists WHERE name = ?");
        $query -> execute([$name]);
        $test = $query -> fetchAll();
        return $test;
    }

    // ajouter un artiste dans la table artists
    public function addArtist($name)
    {
        $query = $this -> connexion -> prepare("INSERT INTO artists (name) VALUES (?)");
        $newEvent = $query -> execute([$name]);
        return $newEvent;
    }

    // afficher les filtres "genre" dans la billetterie
    public function getCategories()
    {
        $query = $this -> connexion -> prepare("SELECT cat_name FROM categories");
        $query -> execute();
        $events = $query -> fetchAll();
        return $events;
    }

    // afficher tous les concerts (sans filtre ou tri) dans la billetterie
    public function getEvents()
    {
        $query = $this -> connexion -> prepare("SELECT id_event, `artist`, date, DATE_FORMAT(date, '%y') AS annee, DATE_FORMAT(date, '%m') AS mois, DATE_FORMAT(date, '%d') AS jour,`poster`,`name`,`category`, on_slider FROM `events` WHERE `date` > NOW()");
        $query -> execute();
        $events = $query -> fetchAll();
        return $events;
    }

    // récupérer tous les concerts, même passés
    public function getAllEvents()
    {
        $query = $this -> connexion -> prepare("SELECT id_event, `artist`,DATE_FORMAT(date, '%d %M %Y') AS date,`poster`,`name`,`category`, on_slider FROM `events`");
        $query -> execute();
        $events = $query -> fetchAll();
        return $events;
    }

    // filtrer QUE par artiste
    public function getEventByArtist($artist)
    {
        $query = $this -> connexion -> prepare("SELECT id_event, `artist`,date, DATE_FORMAT(date, '%y') AS annee, DATE_FORMAT(date, '%m') AS mois, DATE_FORMAT(date, '%d') AS jour,`poster`,`poster`,`name`,`category` FROM events WHERE artist = ?");
        $query -> execute([$artist]);
        $test = $query -> fetchAll();
        return $test;
    }

    // filtrer QUE par catégorie
    public function getEventByCategory($cat)
    {
        $query = $this -> connexion -> prepare("SELECT id_event, `artist`,date, DATE_FORMAT(date, '%y') AS annee, DATE_FORMAT(date, '%m') AS mois, DATE_FORMAT(date, '%d') AS jour,`poster`,`poster`,`name`,`category` FROM events WHERE category = ?");
        $query -> execute([$cat]);
        $test = $query -> fetchAll();
        return $test;
    }

    // filtrer QUE par prix
    public function getEventByPrice($price)
    {
        if($price == "DESC") // si le filtre est par prix décroissant
        {
            $select = "SELECT id_event, `artist`,date, DATE_FORMAT(date, '%y') AS annee, DATE_FORMAT(date, '%m') AS mois, DATE_FORMAT(date, '%d') AS jour,`poster`,`poster`,`name`,`category` FROM events ORDER BY lowest_price DESC";
        }
        elseif($price == "ASC") // si le filtre est par prix croissant
        {
            $select = "SELECT id_event, `artist`,date, DATE_FORMAT(date, '%y') AS annee, DATE_FORMAT(date, '%m') AS mois, DATE_FORMAT(date, '%d') AS jour,`poster`,`poster`,`name`,`category` FROM events ORDER BY lowest_price ASC";
        }
        $query = $this -> connexion -> prepare($select);
        $query -> execute();
        $test = $query -> fetchAll();
        return $test;
    }

    // filtrer QUE par date
    public function getEventByDate($date)
    {
        if($date == "recent") // si le filtre est par date récente
        {
            $select = "SELECT id_event, `artist`,date, DATE_FORMAT(date, '%y') AS annee, DATE_FORMAT(date, '%m') AS mois, DATE_FORMAT(date, '%d') AS jour,`poster`,`poster`,`name`,`category` FROM events ORDER BY date ASC";
        }
        elseif($date == "far") // si le filtre est par date lointaine
        {
            $select = "SELECT id_event, `artist`,date, DATE_FORMAT(date, '%y') AS annee, DATE_FORMAT(date, '%m') AS mois, DATE_FORMAT(date, '%d') AS jour,`poster`,`poster`,`name`,`category` FROM events ORDER BY date DESC";
        }
        $query = $this -> connexion -> prepare($select);
        $query -> execute();
        $test = $query -> fetchAll();
        return $test;
    }

    // récupérer les concerts en fonction de leur nom
    public function getEventByName($name)
    {
        $query = $this -> connexion -> prepare("SELECT artist FROM events WHERE category = ?");
        $query -> execute([$name]);
        $test = $query -> fetchAll();
        return $test;
    }

    // récupérer les éléments selon la saisie de la barre de recherche
    public function getElementsForSearchBar($entry)
    {
        $query = $this -> connexion -> prepare("SELECT artist, id_event FROM events WHERE (artist COLLATE UTF8_GENERAL_CI LIKE ?) OR (artist COLLATE UTF8_GENERAL_CI LIKE ?) LIMIT 5");
        $query -> execute([$entry.'%','%'.$entry.'%']);
        $elements = $query -> fetchAll();
        return $elements;
    }

    // récupérer les concerts selon leur id
    public function getEventById($id)
    {
        $query = $this -> connexion -> prepare("SELECT id_event, artist, date, lowest_price, category, name, description, DATE_FORMAT(time, '%Hh%i') AS time, banner, poster FROM events WHERE id_event = ?");
        $query -> execute([$id]);
        $events = $query -> fetch();
        return $events;
    }

    // supprimer un concert
    public function suppressEvent($id)
    {
        $query = $this -> connexion -> prepare("DELETE FROM events WHERE id_event = ?");
        $supp = $query -> execute([$id]);
        return $supp;
    }

    // ajouter un concert
    public function addEvent($artist, $date, $category, $poster, $name, $description, $time, $price)
    {
        $query = $this -> connexion -> prepare("INSERT INTO events (artist, date, category, poster, name, description, time, lowest_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $newEvent = $query -> execute([$artist, $date, $category, $poster, $name, $description, $time, $price]);
        return $newEvent;
    }

    // ajouter un concert avec une bannière pour le slider
    public function addEventWithBanner($artist, $date, $category, $poster, $name, $description, $slider, $time, $price, $banner)
    {
        $query = $this -> connexion -> prepare("INSERT INTO events (artist, date, category, poster, name, description, on_slider, time, lowest_price, banner) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $newEvent = $query -> execute([$artist, $date, $category, $poster, $name, $description, $slider, $time, $price, $banner]);
        return $newEvent;
    }

    // modifier un concert
    public function editEvent($artist, $date, $category, $name, $description, $time, $price, $id)
    {
        $query = $this -> connexion -> prepare("UPDATE events SET artist = ?, date = ?, category = ?, name = ?, description = ?, time = ?, lowest_price = ? WHERE id_event = ?");
        $modified = $query -> execute([$artist, $date, $category, $name, $description, $time, $price, $id]);
        return $modified;
    }

    // modifier un concert + son poster
    public function editEventWithPoster($artist, $date, $category, $name, $description, $time, $price, $poster_name, $id)
    {
        $query = $this -> connexion -> prepare("UPDATE events SET artist = ?, date = ?, category = ?, name = ?, description = ?, time = ?, lowest_price = ?, poster = ? WHERE id_event = ?");
        $modified = $query -> execute([$artist, $date, $category, $name, $description, $time, $price, $poster_name, $id]);
        return $modified;
    }

    // modifier le slider
    public function changeSlider($banner, $on_slider, $id)
    {
        $query = $this -> connexion -> prepare("UPDATE events SET banner = ?, on_slider = ? WHERE id_event = ?");
        $changed = $query -> execute([$banner, $on_slider, $id]);
        return $changed;
    }

    // récupérer les catégories selon leur nom
    public function getCategoryByName($name)
    {
        $query = $this -> connexion -> prepare("SELECT cat_name FROM categories WHERE cat_name = ?");
        $query -> execute([$name]);
        $cat = $query -> fetch();
        return $cat;
    }

    // créer une nouvelle catégorie
    public function createCategory($name)
    {
        $query = $this -> connexion -> prepare("INSERT INTO categories (cat_name) VALUES (?)");
        $newCat = $query -> execute([$name]);
        return $newCat;
    }

    public function getNumberEvents()
    {
        $query = $this -> connexion -> prepare("SELECT COUNT(*) AS number FROM events WHERE `date` > NOW()");
        $query -> execute();
        $number = $query -> fetch();
        return $number;
    }
}