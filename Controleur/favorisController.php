
<?php 

require_once("../Model/favorisClass.php");

$action = $_GET["action"];


switch ($action) {
    case 'addFavoris':
        $id = $_GET["id"];
        $isAdded = Favoris::setFavoris(new Favoris($id, (int)Utilisateur::getCurrentUser()->getId()));
        echo json_encode($isAdded);
        
        break;
    case 'deleteFavoris':   
        $id = $_GET["id"];
        $isDeleted = Favoris::removeFavoris($id);
        echo json_encode($isDeleted);
        break;
    case 'getFavoris':
        $favoris = Favoris::getFavoris((int)Utilisateur::getCurrentUser()->getId());

        
        break;
    default:
        break;
}




?>