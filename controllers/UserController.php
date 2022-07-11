<?php

require "models/User.php";

class UserController
{
    private $user;
    private $events;
    private $order;
    private $admin;

    public function __construct()
    {
        $this -> user = new User();
        $this -> events = new Event();
        $this -> order = new Order();
        $this -> admin = new AdminController();
    }

    public function addNewsletter() // page d'accueil
    {
        $slides = $this -> events -> getSlider(); // affichage du slider
        $highlights = $this -> events -> getHighlights(); // affichage des concerts en highlight

        $titre = "Radioactive";
        $template = "home";

        if(isset($_POST['email'])) // formulaire d'inscription à la newsletter
        {
            if(!empty($_POST['email']))
            {
                $registered = $this -> user -> getNewsletterByEmail($_POST['email']); // on vérifie sur le mail renseigné est déjà dans la bdd
                if(!$registered) // si il n'est pas déjà dans la bdd
                {
                    $email = htmlspecialchars($_POST['email']);

                    $addToNewsletter = $this -> user -> joinNewsletter($email); // on ajoute le mail dans la bdd newsletter
                    if($addToNewsletter)
                    {
                        $message = "Vous avez bien été ajouté à la Newsletter !";
                        // header("Location:index.php&message=".$message);
                    }
                    else
                    {
                        $message = "Une erreur SQL est survenue.";
                    }
                }
                else
                {
                    $message = "Cet email est déjà abonné à la Newsletter.";
                }
            }
            else
            {
                $message = "Le formulaire n'as pas été correctement rempli.";
            }
        }
        require "www/layout.phtml";
    }

    public function connect() // connexion utilisateur
    {
        $titre = "Connexion";
        $template = "user/login";

        if(isset($_POST["email"]))
        {
            if(!empty($_POST["email"]) && !empty($_POST["password"]))
            {
                $email = htmlspecialchars($_POST["email"]);
                $password = htmlspecialchars($_POST["password"]);

                $existingUser = $this -> user -> getUserByEmail($email); // on vérifie si le mail renseigné correspond à celui d'un membre enregistré

                if($existingUser) // si il est bien enregistré
                {
                    $verifPassword = password_verify($password, $existingUser["password"]); // on vérifie le mdp

                    if($verifPassword) // si le mdp est correct, on connecte
                    {
                        $_SESSION["user"]["email"] = $existingUser["email"];
                        $_SESSION["user"]["name"] = $existingUser["name"];
                        $_SESSION["user"]["lastname"] = $existingUser["lastname"];
                        $_SESSION["user"]["id_user"] = $existingUser["id_user"];
                        header("Location:index.php");
                        exit();
                    }
                    else
                    {
                        $message = "Le mot de passe est erroné.";
                    }
                }
                else
                {
                    $message = "Cet utilisateur n'existe pas.";
                }
            }
            else
            {
                $message = "Le formulaire n'a pas été correctement rempli.";
            }
        }

        require "www/layout.phtml";
    }

    public function register() // création d'un compte utilisateur
    {
        $titre = "S'inscrire";
        $template = "user/register";

        if(isset($_POST["lastname"]) && isset($_POST["name"]) && isset($_POST["date"]) && isset($_POST["adress"]) && isset($_POST["city"]) && isset($_POST["postcode"]) && isset($_POST["country"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["password"]))
        {
            if(!empty($_POST["lastname"]) && !empty($_POST["name"]) && !empty($_POST["date"]) && !empty($_POST["adress"]) && !empty($_POST["city"]) && !empty($_POST["postcode"]) && !empty($_POST["country"]) && !empty($_POST["phone"]) && !empty($_POST["email"]) && !empty($_POST["password"]))
            {
                $registered = $this -> user -> getUserByEmail($_POST["email"]); // on vérifie que le mail renseigné n'est pas déjà associé à un compte dans la bdd
                if(!$registered)
                {
                    if(!empty($_POST["newsletter"]))
                    {
                        $joinnedNewsletter = $this -> user -> getNewsletterByEmail($_POST["email"]); // si la personne coche s'inscrire à la newsletter, vérifie qu'il soit pas déjà dans la bdd newsletter

                        if(!$joinnedNewsletter) // si il n'y est pas
                        {
                            $lastname = htmlspecialchars($_POST["lastname"]);
                            $name = htmlspecialchars($_POST["name"]);
                            $date = htmlspecialchars($_POST["date"]);
                            $adress = htmlspecialchars($_POST["adress"]);
                            $postcode = htmlspecialchars($_POST["postcode"]);
                            $city = htmlspecialchars($_POST["city"]);
                            $country = htmlspecialchars($_POST["country"]);
                            $phone = htmlspecialchars($_POST["phone"]);
                            $email = htmlspecialchars($_POST["email"]);
                            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                            $newsletter = "yes";

                            $createUser = $this -> user -> addUser($lastname, $name, $date, $adress, $postcode, $city, $country, $phone, $email, $password, $newsletter); // on crée le compte en spéficiant son inscription à la newsletter

                            $joinNewsletter = $this -> user -> joinNewsletter($email); // et on l'ajoute dans la table newsletter
                        }
                        else
                        {
                            $lastname = htmlspecialchars($_POST["lastname"]);
                            $name = htmlspecialchars($_POST["name"]);
                            $date = htmlspecialchars($_POST["date"]);
                            $adress = htmlspecialchars($_POST["adress"]);
                            $postcode = htmlspecialchars($_POST["postcode"]);
                            $city = htmlspecialchars($_POST["city"]);
                            $country = htmlspecialchars($_POST["country"]);
                            $phone = htmlspecialchars($_POST["phone"]);
                            $email = htmlspecialchars($_POST["email"]);
                            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                            $newsletter = "yes";

                            $createUser = $this -> user -> addUser($lastname, $name, $date, $adress, $postcode, $city, $country, $phone, $email, $password, $newsletter); // sinon, on crée juste le compte dans l'ajouter dans la table newsletter puisqu'il y est déjà
                        }
                    }
                    else 
                    {
                        $lastname = htmlspecialchars($_POST["lastname"]);
                        $name = htmlspecialchars($_POST["name"]);
                        $date = htmlspecialchars($_POST["date"]);
                        $adress = htmlspecialchars($_POST["adress"]);
                        $postcode = htmlspecialchars($_POST["postcode"]);
                        $city = htmlspecialchars($_POST["city"]);
                        $country = htmlspecialchars($_POST["country"]);
                        $phone = htmlspecialchars($_POST["phone"]);
                        $email = htmlspecialchars($_POST["email"]);
                        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    
                        $createUser = $this -> user -> addUserWithoutNewsletter($lastname, $name, $date, $adress, $postcode, $city, $country, $phone, $email, $password); // si il a coché non à la newsletter, on crée le compte sans l'ajouter à la newsletter

                    }
                    
                    if($createUser)
                    {
                        $message = "Votre compte a bien été créé !";
                        $titre = "Se connecter";
                        $template = "user/login";
                    }
                    else
                    {
                        $message = "Une erreur SQL est survenue !";
                    }
                }
                else
                {
                    $message = "Cet email est déjà utilisé.";
                }
            }
            else
            {
                $message = "Le formulaire n'a pas été correctement rempli.";
            }
        }
        require "www/layout.phtml";
    }

    public function is_connected()
    {
        if(isset($_SESSION['user']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function disconnet() // déconnexion
    {
        session_destroy();

        header('Location:index.php');
        exit();
    }

    public function nextEvent()
    {
        $id = $_SESSION["user"]["id_user"]; 

        $next = $this -> order -> getNextEvent($id);

        if($next)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function userAccount() // espace compte utilisateur
    {
        if($this -> is_connected())
        {
            $titre = "Mon compte";
            $template = "user/userAccount";

            $id = $_SESSION["user"]["id_user"];

            $user = $this -> user -> getUserByEmail($_SESSION["user"]["email"]); // on récupère les informations de l'utilisateur connecté
            $orders = $this -> order -> getOrdersByUser($id); // on récupère ses commandes
            $next = $this -> order -> getNextEvent($id); // on récupère son prochain évènement en date

            if(array_key_exists("myOrders", $_GET)) // modification du titre de la page en fonction de l'url
            {
                $titre = "Mes commandes";
            }
            if(array_key_exists("myInfos", $_GET)) // modification du titre de la page en fonction de l'url
            {
                $titre = "Mes informations";
            }
            require "www/layout.phtml";
        }
        else
        {
            header("Location:index.php");
        }
    }

    public function modifyAccount() // modification du compte utilisateur
    {
        if($this -> is_connected())
        {
            $titre = "Modifier mon compte";
            $template = "user/modifyAccount";

            $user = $this -> user -> getUserByEmail($_SESSION["user"]["email"]); // on récupère l'utilisateur connecté

            if(!empty($_POST))
            {
                if(isset($_POST["lastname"]) && isset($_POST["name"]) && isset($_POST["date"]) && isset($_POST["adress"]) && isset($_POST["city"]) && isset($_POST["postcode"]) && isset($_POST["country"]) && isset($_POST["phone"]) && isset($_POST["email"]))
                {
                    if(!empty($_POST["lastname"]) && !empty($_POST["name"]) && !empty($_POST["date"]) && !empty($_POST["adress"]) && !empty($_POST["city"]) && !empty($_POST["postcode"]) && !empty($_POST["country"]) && !empty($_POST["phone"]) && !empty($_POST["email"]))
                    {
                        $registered = $this -> user -> getUserByEmail($_POST["email"]); // on vérifie le mail
                        if(!$registered || $_POST["email"] === $_SESSION["user"]["email"]) // si le mail n'est pas dans la bdd, OU si il correspond au mail de l'utilisateur enregistré, on peut faire les modifications
                        {
                            $lastname = htmlspecialchars($_POST["lastname"]);
                            $name = htmlspecialchars($_POST["name"]);
                            $date = htmlspecialchars($_POST["date"]);
                            $adress = htmlspecialchars($_POST["adress"]);
                            $postcode = htmlspecialchars($_POST["postcode"]);
                            $city = htmlspecialchars($_POST["city"]);
                            $country = htmlspecialchars($_POST["country"]);
                            $phone = htmlspecialchars($_POST["phone"]);
                            $email = htmlspecialchars($_POST["email"]);
                            $id = $_SESSION["user"]["id_user"]; 

                            $modifiedUser = $this -> user -> updateUser($lastname, $name, $date, $adress, $postcode, $city, $country, $phone, $email, $id); // mise à jour des informations

                            if($modifiedUser)
                            {
                                $message = "Vos informations ont bien été mises à jour.";
                                header("Location:index.php?action=account&myInfos&message=".$message);
                            }
                            else
                            {
                                $message = "Une erreur SQL est survenue.";
                            }
                        }
                        else
                        {
                            $message = "Cet email est déjà utilisé.";
                        }
                    }
                    else
                    {
                        $message = "Le formulaire n'a pas été correctement rempli.";
                    }
                }
            }
            require "www/layout.phtml";
        }
        else
        {
            header("Location:index.php");
        }
    }

    public function modifyPassword() // modification du mot de passe
    {
        if($this -> is_connected())
        {
            $titre = "Modifier mon mot de passe";
            $template = "user/modifyPassword";

            if(isset($_POST["oldPassword"]) && isset($_POST["newPassword"]))
            {
                if(!empty($_POST["oldPassword"]) && !empty($_POST["newPassword"]))
                {

                    $oldPassword = htmlspecialchars($_POST["oldPassword"]);
                    $newPassword = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
                    $email = $_SESSION["user"]["email"]; 
                    $id = $_SESSION["user"]["id_user"];

                    $existingUser = $this -> user -> getUserByEmail($email);

                    $verifPassword = password_verify($oldPassword, $existingUser["password"]);

                    if($verifPassword)
                    {
                        $updatePassword = $this -> user -> updatePassword($newPassword, $id); 

                        if($updatePassword)
                        {
                            $message = "Votre mot de passe a bien été mis à jour.";
                            header("Location:index.php?action=account&myInfos&message=".$message);
                        }
                        else
                        {
                            $message = "Une erreur SQL est survenue.";
                        }
                    }
                    else
                    {
                        $message = "L'ancien mot de passe est erroné.";
                    }

                }
                else
                {
                    $message = "Le formulaire n'a pas été correctement rempli.";
                }
            }
            require "www/layout.phtml";
        }
        else
        {
            header("Location:index.php");
        }
    }

    public function deleteUser() // suppression du compte utilisateur
    {
        if($this -> is_connected())
        {
            $titre = "Supprimer mon comtpe";
            $template = "user/deleteUser";

            $id = $_SESSION["user"]["id_user"];
            $email = $_SESSION["user"]["email"];

            if(isset($_POST["deleteAccount"]))
            {
                if(!empty($_POST["deleteAccount"]))
                {
                    if($_POST["deleteAccount"] == "yes") // si la personne coche oui pour la suppression
                    {
                        $suppAccount = $this -> user -> delete($id); // on supprime le compte
                        if($suppAccount)
                        {
                            session_destroy(); // et on déconnecte
                            $message = "Votre compte a bien été supprimé.";
                            header("Location:index.php?action=login&message=".$message);
                        }
                    }
                }
            }
            elseif(isset($_POST["deleteNewsletter"]))
            {
                if(!empty($_POST["deleteNewsletter"]))
                {
                    if($_POST["deleteNewsletter"] == "yes") // si la personne coche désinscrire de la newsletter
                    {
                        $answer = "";
                        $supp = $this -> user -> deleteNewsletter($email); // on supprime dans la table newsletter
                        $update = $this -> user -> updateNewsletter($answer, $id); // et on modifie le compte
                        
                        if($supp)
                        {
                            $message = "Votre demande de retrait de la newsletter a bien été prise en compte.";
                            header("Location:index.php?action=account&myInfos&message=".$message);
                        }
                    }
                }
            }
            elseif(isset($_POST["deleteNewsletter"]) && isset($_POST["deleteAccount"]))
            {
                if(!empty($_POST["deleteNewsletter"]) && !!empty($_POST["deleteAccount"]))
                {
                    if($_POST["deleteNewsletter"] == "yes" && $_POST["deleteAccount"] == "yes") // si a personne choche les deux
                    {
                        $suppAccount = $this -> user -> delete($id); // on supprime le compte
                        $supp = $this -> user -> deleteNewsletter($email); // et on retire de la table

                        if($suppAccount)
                        {
                            $message = "Votre compte a bien été supprimé et votre demande de retrait de la newsletter a bien été pris en compte.";
                            // header("Location:index.php?action=login&message=".$message);
                            session_destroy();
                        }
                    }
                }
            }
            require "www/layout.phtml";
        }
        else
        {
            header("Location:index.php");
        }
    }

    public function changeNewsletter() // modification de la newsletter
    {
        if($this -> is_connected())
        {
            $titre = "Modifier la newsletter";
            $template = "user/changeNewsletter";

            if($this -> newsletter_joined()) // si le compte est abonné à la newsletter, on propose de l'en retirer
            {
                if(isset($_POST["deleteNewsletter"]))
                {
                    if(!empty($_POST["deleteNewsletter"]))
                    {
                        if($_POST["deleteNewsletter"] == "yes") // si la personne coche oui
                        {
                            $email = $_SESSION["user"]["email"]; 
                            $id = $_SESSION["user"]["id_user"];

                            $answer = "";
                            $supp = $this -> user -> deleteNewsletter($email);
                            $update = $this -> user -> updateNewsletter($answer, $id);
                            
                            if($supp)
                            {
                                $message = "Vous avez bien été retiré de notre newsletter.";
                                header("Location:index.php?action=account&myInfos&message=".$message);
                            }
                        }
                    }
                }
            }
            else // si la personne est pas abonnée, on propose de l'y ajouter
            {
                if(isset($_POST["addNewsletter"]))
                {
                    if(!empty($_POST["addNewsletter"]))
                    {
                        if($_POST["addNewsletter"] == "yes") // si la personne coche oui
                        {
                            $email = $_SESSION["user"]["email"]; 
                            $id = $_SESSION["user"]["id_user"];
                            $answer = "yes";
        
                            $addToNewsletter = $this -> user -> joinNewsletter($email);
                            $update = $this -> user -> updateNewsletter($answer, $id);
                            
                            if($addToNewsletter)
                            {
                                $message = "Vous avez bien été inscrit à notre newsletter.";
                                header("Location:index.php?action=account&myInfos&message=".$message);
                            }
                        }
                    }
                }
            }
            require "www/layout.phtml";
        }
        else
        {
            header("Location:index.php");
        }
    }

    public function newsletter_joined()
    {
        $email = $_SESSION["user"]["email"]; 

        $user = $this -> user -> getUserByNewsletter($email);

        if($user)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function showAllusers() // dans la partie admin, la liste des utilisateurs
    {
        if($this -> admin -> admin_connected())
        {
            $titre = "Liste des utilisateurs";
            $template = "admin/adminUsers";

            $users = $this -> user -> getUsers(); // on récupère la liste des utilisateurs dans la bdd

            if(array_key_exists("id", $_GET)) // page détail par utilisateur
            {
                $id = $_GET["id"];

                $titre = "Utilisateur n° ".$id; 

                $user = $this -> user -> getUserById($id); // on récupère ses informations
                $orders = $this -> order -> getOrdersByUser($id); // on récupère ses commandes
            }
            require "www/layoutAdmin.phtml";
        }
        else
        {
            header("Location:index.php");
        }
    }

    public function contact() // page contacter
    {
        $titre = "Nous contacter";
        $template = "contact";

        if(isset($_POST["lastname"]) && isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["object"]) && isset($_POST["message"]))
        {
            if(!empty($_POST["lastname"]) && !empty($_POST["name"]) && !empty($_POST["phone"]) &&!empty($_POST["email"]) && !empty($_POST["object"]) && !empty($_POST["message"]))
            {
                if($this -> is_connected()) // si une session utilisateur est ouverte
                {
                    $id = $_SESSION["user"]["id_user"]; // dans la bdd on ajoute l'id utilisateur
                }
                else
                {
                    $id = "0"; // sinon, on lui donne l'id 0, qui indique qu'il s'agit d'un invité (pas de compte utilisateur)
                }

                $lastname = htmlspecialchars($_POST["lastname"]);
                $name = htmlspecialchars($_POST["name"]);
                $phone = htmlspecialchars($_POST["phone"]);
                $email = htmlspecialchars($_POST["email"]);
                $object = htmlspecialchars($_POST["object"]);
                $contact = htmlspecialchars($_POST["message"]);
                $date = date('y-m-d h:i:s');

                $sendmessage = $this -> user -> sendMessage($id, $lastname, $name, $phone, $email, $object, $contact, $date);

                if($sendmessage)
                {
                    $message = "Votre message a bien été envoyé.";
                    header("Location:index.php?action=contact&message=".$message);
                }
                else
                {
                    $message = "Une erreur SQL est survenue.";
                }
            }
            else
            {
                $message = "Le formulaire n'a pas été rempli correctement.";
            }
        }

        require "www/layout.phtml";
    }

    public function practical() // page infos pratiques
    {
        $titre = "Infos pratiques";
        $template = "practical";

        require "www/layout.phtml";
    }

    public function showMessages() // partie admin, page messages reçus
    {
        if($this -> admin -> admin_connected())
        {
            $titre = "Messages";
            $template = "admin/adminMessages";

            $contacts = $this -> user -> getMessages(); // on récupère tous les messages

            if(array_key_exists("id", $_GET)) // si on visualise un message
            {
                $id = $_GET["id"];

                $titre = "Message n° ".$id;

                $message = $this -> user -> getMessageById($id); // on récupère le message en question
            }
            require "www/layoutAdmin.phtml";
        }
        else
        {
            header("Location:index.php");
        }
    }

    public function suppMessage() // partie admin, supprimer message
    {
        if($this -> admin -> admin_connected())
        {
            if(array_key_exists("id", $_GET)) // suppression en fonction de l'id du message
            {
                $id = $_GET["id"];

                $supp = $this -> user -> suppressMessage($id); // suppression du message

                if($supp)
                {
                    $message = "Le message a bien été supprimé.";
                    header("Location:index.php?action=adminMessages&message=".$message);
                }
            }
        }
        else
        {
            header("Location:index.php");
        }
    }
}