<?php 
require_once("../Model/mailClass.php");

$mailer = new Mailer(); 

$adresseUser = $_GET["email"];
$action = $_GET["action"];

switch ($action) {
    case 'reinitialisation':
        $mailer->envoyerReinitialisationMdp($adresseUser);
        header("Location: ../Vue/html/connexion.php");
        break;
    case 'confirmation':
        $mailer->envoyerConfirmationInscription($adresseUser);
        header("Location: ../Vue/html/connexion.php");
        break;
    case 'connexion':
        $mailer->envoyerConnexion($adresseUser);
        header("Location: ../Vue/html/acceuil.html");
        break;
    default:
        break;
}

?>