<?php require_once("../../Model/utilisateurClass.php"); 
require_once("../../Model/favorisClass.php");

$favoris;
 $user = Utilisateur::getCurrentUser();
    if ($user === null) {
        header("Location: ../html/connexion.php");
    } else {
        $idUser = $user->getId();
        $favoris = Favoris::getFavoris($idUser);
        
    }





?>


<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="../css/favorie.css">
        <link type="text/css" rel="stylesheet" href="../css/header6.css">
        <link type="text/css" rel="stylesheet" href="../css/ff.css">
        <title>acceuil</title>
    

    <script src="../js/header.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Accueil - Naturalia</title>
</head>

<body>
<header>
        <nav>
            <ul>
                <li><a class="titre" href="../html/acceuil.html">Naturalia</a></li>                    
                <li><a class="active" href="../html/quiz.html">Quiz du jour</a></li>
                <li><a class ="active" href="../html/recherche.html">Encyclopédie des espèces</a></li>
                <li><a class="active" href="../html/ecriture.php">Créer un post</a></li>
                <li class="search-bar"><input type="text" placeholder="Rechercher" /><button class="recherche" type="submit"><img src="../img/loupe.png" alt="" width="20" height="20"></button>
                    <div class="dropdown">
                        <li><img onclick="myFunction()" class="icone" src="../img/utilisateur.png" alt="" width="30" height="30"></li>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="../html/profil.php">Mon profil</a>
                            <a href="../html/favoris.php">Mes favoris</a>
                            <a href="../html/friend.php">Mes amis</a>
                            <a href="">Se déconnecter</a>
                        </div>
                        </div>
            </ul>
        </nav>
        <div class="feuille">
            <img src="../img/feuille.png" alt="" width="70" height="70">
        </div>

</header>
    <br>

    <section id="liste-posts">
        <div class="container">
            <h1>Vos favoris</h1>
            <?php
                if (empty($favoris)) {
                    echo "<div class='favorites-icon'><img src='../img/ETOILE-JAUNE.png' alt='Star with plus sign'>
                </div>";
                } else {
                    echo "<ul class='flex-container'>";
                    foreach ($favoris as $favori) {
                        $id = $favori['idTaxon'];
                        $resultat = Favoris::retrieveTaxon($favori['idTaxon']);
                        echo "<li class='flex-item' onclick=\"window.location.href='./displayTaxon.php?id=$id'\">";
                        echo "<label>" . $resultat['frenchVernacularName'] . "</label>";    
                        if (isset($resultat['taxonMedia'])){
                            echo "<img src='" . $resultat['taxonMedia'] . "' alt='placeholder' width='200' height='200' >";
                        } else {
                            echo "<img src='../img/Image_manquante.png' alt='placeholder' width='200' height='200'>";

                        }
                        echo "</li>";



                    }
                }
            ?>
        </div>
    </section>
    <BR>


    <footer class="site-footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>À propos de nous</h3>
            <p>Notre site est une fenêtre ouverte 
                <br>sur l'extraordinaire diversité de la vie animale.
                <br> chaque espèce joue un rôle unique dans l'équilibre de la nature.</p>
        </div>
        <div class="footer-section">
            <h3>Contact</h3>
            <p>Email : Naturalia@gmail.fr</p>
            <p>Téléphone : <br> +33 7 78 70 81 53</p>
        </div>
        <div class="footer-section">
            <h3>Newsletter</h3>
            <p>Inscrivez-vous pour recevoir des mises à jour et des informations fascinantes sur la diversité de la vie animale.</p>
            <input type="email" name="email" placeholder="Entrez votre email">
            <button type="submit">S'abonner</button>
        </div>
    </div>
    <div class="footer-bottom">
        <h3>&copy; 2023 NATURALIA.com - Tous droits réservés </h3>
    </div>
</footer>
</body>

</html>