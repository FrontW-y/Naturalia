<?php

require_once("../Model/utilisateurClass.php");

$action = $_GET["action"] ?? null;

switch ($action) {
    case "connexion":
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $user = Utilisateur::getUser($email, $password);
                if ($user !== null) {
                $reponse = file_get_contents("mailController.php?action=connexion&email=$email");
                echo $reponse;
            header("Location: ../Vue/html/acceuil.html");
            } else {
                $_SESSION['CONNEXION_ERROR'] = "Email ou mot de passe incorrect";
                header("Location: ../Vue/html/connexion.html");
            }
        }
        break;

    case "inscription":
        if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["motdepasse"]) && isset($_POST["prenom"]) && isset($_POST["nom"]) && isset($_POST["date_naissance"])) {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = password_hash($_POST["motdepasse"], PASSWORD_DEFAULT);
            $fName = $_POST["prenom"];
            $lName = $_POST["nom"];
            $dateNaissance = $_POST["date_naissance"];
            if (Utilisateur::insertUser($username, $email, $password, $fName, $lName, $dateNaissance)) {
                $reponse = file_get_contents("mailController.php?action=confirmation&email=$email");
                header("Location: ../Vue/html/connexion.php");
            } else {
                header("Location: ../Vue/html/inscription.php");
            }
        }
        break;

    case "deconnexion":
        unset($_COOKIE["token"]);
        header("Location: ../Vue/html/acceuil.html");
        break;

    case "ajouterAmi":
        if (isset($_COOKIE["token"]) && isset($_POST["friend"])) {
            $user = Utilisateur::getCurrentUser();
            $friend = $_POST["friend"];
            $user->addFriend($friend);
            header("Location: ../Vue/html/friend.php");
        } else {
            header("Location: ../Vue/html/connexion.php");
        }


        default:
        echo $action;
            break;

}




?>