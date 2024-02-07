<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require_once "../Model/utilisateurClass.php";

class Mailer {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->setup();
    }

    private function setup() {
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER; 
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'naturialia@gmail.com';
        $this->mail->Password = 'egcmrlyapeqtqefn';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465;
    }

    public function envoyerReinitialisationMdp($userMail) {
        try {
            $nouveauPassWd = Utilisateur::createPassWd();
            $this->mail->setFrom('naturialia@gmail.com', 'Naturalia Support Team');
            $this->mail->addAddress($userMail);
            $this->mail->isHTML(true);
            $this->mail->Subject = "Demande de re initialisation de votre mot de passe";
            $this->mail->Body = "<p>Votre nouveau mot de passe a été généré.</p>
            <details>
                <summary>Afficher le mot de passe</summary>
                <p>Votre nouveau mot de passe est : <b>$nouveauPassWd</b></p>
            </details>";
            $this->mail->AltBody = "Votre nouveau mot de passe est : $nouveauPassWd";
            if(Utilisateur::setPassWd($nouveauPassWd, $userMail)) {
                $this->mail->send();            
            } 
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return 1;
    }

    public function envoyerConfirmationInscription($userMail) {
        try {
            $this->mail->setFrom('naturialia@gmail.com', 'Naturalia Support Team');
            $this->mail->addAddress($userMail);
            $this->mail->isHTML(true);
            $this->mail->Subject = "Confirmation de votre inscription";
            $this->mail->Body = "<p>Bonjour, $userMail, nous vous signalons que votre inscription a bien été prise en compte.</p>";
            $this->mail->AltBody = "Bonjour, $userMail, nous vous signalons que votre inscription a bien été prise en compte.";
            $this->mail->send();            
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return 1;
    }

    public function envoyerConnexion($userMail) {
        try {
            $ipConnexion = $_SERVER['REMOTE_ADDR'];
            $this->mail->setFrom('naturialia@gmail.com', 'Naturalia Support Team');
            $this->mail->addAddress($userMail);
            $this->mail->isHTML(true);
            $this->mail->Subject = "Alerte connexion à votre compte";
            $this->mail->Body = "<p>Bonjour, $userMail, nous vous singalons une nouvelle conexion a votre compte depuis $ipConnexion.</p>";
            $this->mail->AltBody = "Bonjour, $userMail, nous vous singalons une nouvelle conexion a votre compte depuis $ipConnexion.";
            $this->mail->send();            
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return 1;
    }
}
