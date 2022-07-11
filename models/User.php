<?php

class User
{
    private $database;
    private $connexion;

    public function __construct()
    {
        $this -> database = new Database();
        $this -> connexion = $this -> database -> getConnexion();
    }

    public function joinNewsletter($email) 
    {
        $query = $this -> connexion -> prepare("INSERT INTO newsletter (email) VALUES (?)");
        $newsletter = $query -> execute([$email]);
        return $newsletter;
    }

    public function getNewsletterByEmail($email)
    {
        $query = $this -> connexion -> prepare("SELECT email FROM newsletter WHERE email = ?");
        $query -> execute([$email]);
        $follower = $query -> fetch();
        return $follower;
    }

    public function addUser($lastname, $name, $date, $adress, $postcode, $city, $country, $phone, $email, $password, $newsletter)
    {
        $query = $this -> connexion -> prepare("INSERT INTO users (lastname, name, birthdate, adress, postcode, city, country, phone, email, password, newsletter) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $user = $query -> execute([$lastname, $name, $date, $adress, $postcode, $city, $country, $phone, $email, $password, $newsletter]);
        return $user;
    }

    public function addUserWithoutNewsletter($lastname, $name, $date, $adress, $postcode, $city, $country, $phone, $email, $password)
    {
        $query = $this -> connexion -> prepare("INSERT INTO users (lastname, name, birthdate, adress, postcode, city, country, phone, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $user = $query -> execute([$lastname, $name, $date, $adress, $postcode, $city, $country, $phone, $email, $password]);
        return $user;
    }

    public function getUserByEmail($email)
    {
        $query = $this -> connexion -> prepare("SELECT lastname, name, DATE_FORMAT(birthdate, '%d/%m/%Y') AS birthdate, adress, postcode, city, country, phone, email, password, id_user, password FROM users WHERE email = ?");
        $query -> execute([$email]);
        $registered = $query -> fetch();
        return $registered;
    }

    public function updateUser($lastname, $name, $birthdate, $adress, $postcode, $city, $country, $phone, $email, $id)
    {
        $query = $this -> connexion -> prepare("UPDATE users SET lastname = ?, name = ?, birthdate = ?, adress = ?, postcode = ?, city = ?, country = ?, phone = ?, email = ? WHERE id_user = ? ");
        $modified = $query -> execute([$lastname, $name, $birthdate, $adress, $postcode, $city, $country, $phone, $email, $id]);
        return $modified;
    }

    public function updatePassword($newPassword, $id)
    {
        $query = $this -> connexion -> prepare("UPDATE users SET password = ? WHERE id_user = ?");
        $modified = $query -> execute([$newPassword, $id]);
        return $modified;
    }

    public function delete($id)
    {
        $query = $this -> connexion -> prepare("DELETE FROM users WHERE id_user = ?");
        $supp = $query -> execute([$id]);
        return $supp;
    }

    public function deleteNewsletter($email)
    {
        $query = $this -> connexion -> prepare("DELETE FROM newsletter WHERE email = ?");
        $supp = $query -> execute([$email]);
        return $supp;
    }

    public function updateNewsletter($answer, $id)
    {
        $query = $this -> connexion -> prepare("UPDATE users SET newsletter = ? WHERE id_user = ?");
        $supp = $query -> execute([$answer, $id]);
        return $supp;
    }

    public function getUserByNewsletter($email)
    {
        $query = $this -> connexion -> prepare("SELECT id_user FROM users WHERE email = ? AND newsletter = 'yes'");
        $query -> execute([$email]);
        $user = $query -> fetch();
        return $user;
    }

    public function getNewsletters()
    {
        $query = $this -> connexion -> prepare("SELECT email FROM newsletter");
        $query -> execute();
        $newsletters = $query -> fetchAll();
        return $newsletters;
    }

    public function getUsers()
    {
        $query = $this -> connexion -> prepare("SELECT id_user, lastname, name, email, adress, postcode, city, country, phone FROM users ORDER BY id_user ASC");
        $query -> execute();
        $users = $query -> fetchAll();
        return $users;
    }

    public function getUserById($id)
    {
        $query = $this -> connexion -> prepare("SELECT lastname, name, DATE_FORMAT(birthdate, '%d/%m/%Y') AS birthdate, adress, postcode, city, country, phone, email, id_user FROM users WHERE id_user = ?");
        $query -> execute([$id]);
        $registered = $query -> fetch();
        return $registered;
    }

    public function sendMessage($id, $lastname, $name, $phone, $email, $object, $message, $date)
    {
        $query = $this -> connexion -> prepare("INSERT INTO contact (id_user, lastname, name, phone, email, object, message, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $contact = $query -> execute([$id, $lastname, $name, $phone, $email, $object, $message, $date]);
        return $contact;
    }

    public function getMessages()
    {
        $query = $this -> connexion -> prepare("SELECT id_message, id_user, object, DATE_FORMAT(date, '%d/%m/%Y à %Hh%i') AS date FROM contact ORDER BY date ASC");
        $query -> execute();
        $contact = $query -> fetchAll();
        return $contact;
    }

    public function getMessageById($id)
    {
        $query = $this -> connexion -> prepare("SELECT id_message, id_user, lastname, name, phone, email, object, message, DATE_FORMAT(date, '%d/%m/%Y à %Hh%i') AS date FROM contact WHERE id_message = ?");
        $query -> execute([$id]);
        $contact = $query -> fetch();
        return $contact;
    }

    public function suppressMessage($id)
    {
        $query = $this -> connexion -> prepare("DELETE FROM contact WHERE id_message = ?");
        $supp = $query -> execute([$id]);
        return $supp;
    }

    public function getNumberAccounts()
    {
        $query = $this -> connexion -> prepare("SELECT COUNT(*) AS number FROM users");
        $query -> execute();
        $number = $query -> fetch();
        return $number;
    }
}