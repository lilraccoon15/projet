<?php

class Admin
{
    private $database;
    private $connexion;

    public function __construct()
    {
        $this -> database = new Database();
        $this -> connexion = $this -> database -> getConnexion();
    }

    public function getAdminByEmail($email) // récupération de l'admin en fonction de l'email
    {
        $query = $this -> connexion -> prepare("SELECT email, password, pseudo, id_admin FROM admin WHERE email = ?");
        $query -> execute([$email]);
        $admin = $query -> fetch();
        return $admin;
    }

    public function modifyPassword($newPassword, $id)
    {
        $query = $this -> connexion -> prepare("UPDATE admin SET password = ? WHERE id_admin = ?");
        $modified = $query -> execute([$newPassword, $id]);
        return $modified;
    }

    public function modifyEmail($newEmail, $id)
    {
        $query = $this -> connexion -> prepare("UPDATE admin SET email = ? WHERE id_admin = ?");
        $modified = $query -> execute([$newEmail, $id]);
        return $modified;
    }

    public function modifyAll($newPassword, $newEmail, $id)
    {
        $query = $this -> connexion -> prepare("UPDATE admin SET password = ?, email = ? WHERE id_admin = ?");
        $modified = $query -> execute([$newPassword, $newEmail, $id]);
        return $modified;
    }

}