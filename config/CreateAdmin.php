<?php

require "Database.php";

class CreateAdmin
{
    private $database;
    private $connexion;
    
    public function __construct()
    {
        $this -> database = new Database();
        $this -> connexion = $this -> database -> getConnexion();
    }    
    
    public function insertAdmin($pseudo, $email, $mdp)
    {

        $query = $this -> connexion -> prepare("INSERT INTO admin (pseudo, email, password) VALUES (?,?,?)");
        
        $admin = $query -> execute([$pseudo, $email, $mdp]);
    
        return $admin;
    }
}

$addAdmin = new CreateAdmin();

$pseudo = 'Camille Lefort';
$email = "camille.lefort15@gmail.com";
$mdp = password_hash("march2022", PASSWORD_DEFAULT);
     
$addAdmin -> insertAdmin($pseudo, $email, $mdp);

if($addAdmin)
{
    header("Location:../index.php");
}
else
{
    echo "Une erreur est survenue lors de la création du compte Administrateur.";
}

