<?php 

require_once("utilisateurClass.php");
require_once('TaxrefAPI.php');

require_once('../../Controleur/TaxrefController.php');



use traitement\TaxrefAPI;
use traitement\TaxrefController;

class Favoris {

    private int $idTaxon = 0;
    private int $idUser = 0;


    public function __construct(int $idTaxon, int $idUser)
    {
        $this->idTaxon = $idTaxon;
        $this->idUser = $idUser;
    }

    public static function setFavoris(Favoris $favoris): bool
    {
        $pdo = Model::getPdo();
        $values = ["idTaxon" => $favoris->idTaxon, "idUser" => $favoris->idUser];
        $stmt = "INSERT INTO favoris (idUtilisateur, idTaxon) VALUES (:idUser, :idTaxon)";
        $stmt = $pdo->prepare($stmt);
        return $stmt->execute($values);
    }

    public static function getFavoris(int $idUser): array {

        $pdo = Model::getPdo();
        $stmt = "SELECT * FROM favoris WHERE idUtilisateur = :idUser";
        $stmt = $pdo->prepare($stmt);
        $stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(); 
    }

    public static function removeFavoris(int $idTaxon): bool {

        $pdo = Model::getPdo();
        $user = Utilisateur::getCurrentUser();
        $idUser = $user->getId();
        $stmt = "DELETE FROM favoris WHERE idUtilisateur = :idUser AND idTaxon = :idTaxon";
        $stmt = $pdo->prepare($stmt);
        $stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        $stmt->bindParam(":idTaxon", $idTaxon, PDO::PARAM_INT);
        return $stmt->execute(); 
    }

    public static function retrieveTaxon($id){
        $api = new TaxrefAPI();
        $controller = new TaxrefController($api);
        $resultat = $controller->afficher($id);
        $mediaUrl = $resultat['_links']['media']['href'];
        $mediaContent = file_get_contents($mediaUrl);
        $mediaData = json_decode($mediaContent, true);
        
        
        try {
            $resultat["factSheet"] = $controller->factsheet($id);

        } catch (Exception $e) {
            $resultat["factSheet"] = "Aucune donnée complementaire disponible disponible";
        }

        if (!empty($mediaData['_embedded']['media'][0]['_links']['file']['href'])) {
            $taxonThumbnailUrl = $mediaData['_embedded']['media'][0]['_links']['file']['href'];
            $resultat['taxonMedia'] = $taxonThumbnailUrl;
        }

        return $resultat;
    }
}


?>