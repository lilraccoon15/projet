<?php

require "models/Admin.php";

class AdminController
{
    private $admin;
    private $events;
    private $order;
    private $user;


    public function __construct()
    {
        $this -> admin = new Admin();
        $this -> events = new Event();
        $this -> order = new Order();
        $this -> user = new User();
    }

    public function admin() // connexion au compte admin
    {
        $titre = "Panneau d'administration";
        $template = "admin/homeAdmin";

        $sells = $this -> order -> getLastSells();
        $members = $this -> user -> getNumberAccounts();
        $concerts = $this -> events -> getNumberEvents();

        if(isset($_POST["email"]))
        {
            if(!empty($_POST["email"]) && !empty($_POST["password"]))
            {
                $email = htmlspecialchars($_POST["email"]);
                $password = htmlspecialchars($_POST["password"]);

                $admin = $this -> admin -> getAdminByEmail($email); // on vérifie si l'email de l'admin est dans la bdd

                if($admin)
                {
                    // si l'email est dans la bdd on vérifie le mdp renseigné
                    $verifPassword = password_verify($password, $admin["password"]);

                    if($verifPassword)
                    {
                        // si le mdp est vérifié, on ouvre la session
                        $_SESSION["admin"]["email"] = $admin["email"];
                        $_SESSION["admin"]["pseudo"] = $admin["pseudo"];
                        $_SESSION["admin"]["id"] = $admin["id_admin"];
                        header("Location:index.php?action=admin");
                        exit();
                    }
                    else
                    {
                        $message = "Le mot de passe saisi est incorrect.";
                    }
                }
                else
                {
                    $message = "Cet administrateur n'existe pas.";
                }
            }
            else
            {
                $message = "Le formulaire n'a pas été rempli correctement.";
            }
        }
        require "www/layoutAdmin.phtml";
    }

    public function admin_connected() // si la session admin est ouverte
    {
        if(isset($_SESSION["admin"]))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function modify() // modifier le compte admin
    {
        if($this -> admin_connected())
        {
            $titre = "Modification du compte Administrateur";
            $template = "admin/modifyAdmin";

            if(isset($_POST["oldEmail"]) && isset($_POST["oldPassword"]))
            {
                if(!empty($_POST["oldEmail"]) && !empty($_POST["oldPassword"]))
                {
                    $email = $_SESSION["admin"]["email"];
                    $oldEmail = htmlspecialchars($_POST["oldEmail"]);
                    $oldPassword = htmlspecialchars($_POST["oldPassword"]);

                    $existingAdmin = $this -> admin -> getAdminByEmail($email);

                    $id = $_SESSION["admin"]["id"];
                    $newEmail = htmlspecialchars($_POST["newEmail"]);
                    $newPassword = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);

                    if(!empty($_POST["newEmail"]) && empty($_POST["newPassword"])) // si on change uniquement le mail
                    {
                        if($oldEmail === $email) // si l'ancien email correspond à celui de l'administrateur connecté
                        {
                            $verifPassword = password_verify($oldPassword, $existingAdmin["password"]); // vérification du mdp renseigné

                            if($verifPassword)
                            {
                                $updatePassword = $this -> admin -> modifyEmail($newEmail, $id); // si le mdp est bon, on modifie le nouvel email renseigné

                                if($updatePassword)
                                {
                                    $message = "L'adresse email a bien été modifiée.";
                                }
                            }
                            else
                            {
                                $message = "Le mot de passe est erroné.";
                            }
                        }
                        else
                        {
                            $message = "L'adresse email est erronée.";
                        }
                    }
                    elseif(!empty($_POST["newPassword"]) && empty($_POST["newEmail"])) // si on change uniquement le mot de passe
                    {
                        if($oldEmail === $email)
                        {
                            $verifPassword = password_verify($oldPassword, $existingAdmin["password"]);

                            if($verifPassword)
                            {
                                $updatePassword = $this -> admin -> modifyPassword($newPassword, $id); 

                                if($updatePassword)
                                {
                                    $message = "Le mot de passe a bien été modifié.";
                                }
                            }
                            else
                            {
                                $message = "Le mot de passe est erroné.";
                            }
                        }
                        else
                        {
                            $message = "L'adresse email est erronée.";
                        }
                    }
                    elseif(!empty($_POST["newEmail"]) && !empty($_POST["newPassword"])) // si on change les deux
                    {
                        if($oldEmail === $email)
                        {
                            $verifPassword = password_verify($oldPassword, $existingAdmin["password"]);

                            if($verifPassword)
                            {
                                $updateAll = $this -> admin -> modifyAll($newPassword, $newPassword, $id);

                                if($updateAll)
                                {
                                    $message = "L'adresse email et le mot de passe ont bien été modifiés.";
                                }
                            }
                            else
                            {
                                $message = "Le mot de passe est erroné.";
                            }
                        }
                        else
                        {
                            $message = "L'adresse email est erronée.";
                        }
                    }
                    elseif(empty($_POST["newEmail"]) && empty($_POST["newPassword"]))
                    {
                        $message = "Le formulaire n'a pas été rempli correctement.";
                    }
                }
                else
                {
                    $message = "Le formulaire n'a pas été rempli correctement.";
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