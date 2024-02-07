<?php
require_once("../../Model/postClass.php");

$id = $_GET["id"] ?? null;

$post = Post::getPost($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../css/ff.css">
    <link type="text/css" rel="stylesheet" href="../css/header6.css">
    <link type="text/css" rel="stylesheet" href="../css/article.css">
    <script src="../js/connexion.js"></script>

    <title>Nos articles</title>
</head>

<body>
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
        <!-- Titre de la Page -->

        <?php echo "<h1 class='page-title'>" . $post["postTitre"] . "</Article></h1>"; ?>
        <br>

        <div class="content-container">
            <!-- Carousel pour les photos -->
            <div class="carousel">
                <?php
                if ($post["hasImg"] == 1) {
                    echo "<img class='carousel-image' src='" . $post["imgPath"] . "' alt='Image 1'>";
                } else {
                    echo "<img class='carousel-image' src='../img/feuille.png' alt='Image 1'>";
                }
                ?>

            </div>

            <!-- Section pour le texte -->
            <div class="text-container">
                <section class="text-section">
                    <!-- Votre Texte ici -->
                    <?php echo ("<p>" . $post["PostCorps"] . "</p>"); ?>
                </section>
            </div>
        </div>
        <br>
        <div class="feedback-container">
            <h1 class="button-title">Avez-vous aimé cet article ?</h1>
            <button id="like-btn">👍</button>
            <button id="dislike-btn">👎</button>
            <p id="feedback-message"></p>
        </div>

        <br>
        <br>

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

        <script src="../js/Carousel.JS"></script>
        <script src="../js/postAfficherBoutons.JS"></script>

    </body>

</html>