<?php

require_once('../../Model/utilisateurClass.php');
$data;
if (isset($_COOKIE["token"])) {
    $user = Utilisateur::getCurrentUser();
    if ($user === null) {
        header("Location: ../html/connexion.php");
    }

    $data = $user->getSelfInfo();
    $id = $data["id"];

} else {
    header("Location: ../html/connexion.php");
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../css/ecriture.css">
    <link type="text/css" rel="stylesheet" href="../css/header6.css">
    <script src="../js/connexion.js"></script>
    <link type="text/css" rel="stylesheet" href="../css/ff.css">
    <title> Creation D'article </title>
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



    <?php echo "<form id='articleForm' action='../../Controleur/postController.php?action=post&idPoster=$id' method='POST' enctype='multipart/form-data'>"; ?>
    <section class="main-title">
        <h1>Créer votre Article</h1>
    </section>

    <section class="title-section">
        <input type="text" id="articleTitle" name="titre" placeholder="Entrez le titre de l'article ici">
    </section>

    <section class="editor">
        <div class="toolbar">
            <!--  boutons pour la mise en forme -->
            <button id="btnBold" type="button" class="toolbar-button" onclick="toggleBold();">Gras</button>
            <button id="btnUnderline" type="button" class="toolbar-button"
                onclick="toggleUnderline();">Souligner</button>
            <button id="btnItalic" type="button" class="toolbar-button" onclick="toggleItalic();">Italique</button>


            <br><br>
        </div>
        <div contenteditable="true" id="editableDiv" class="textArea"></div>
        <input type="text" id="htmlContent" name="contenu" style="display: none;">
        <script src="../js/ecriture.js"></script>

    </section>


    <section class="upload-section">
        <label for="imageUpload">Ajouter des images :</label>
        <br>
        <input type="file" id="imageUpload" name="img" accept="image/*" multiple>
    </section>

    <div id="imagePreview" class="image-preview">
        <!-- Les images téléchargées seront affichées ici -->
    </div>

    <div class="button-container">
        <input type="submit" class="submit-button"></button>
    </div>



    </form>
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
    <script src="../js/balise_ecriture.js"></script>
    <script src="../js/AjtPhoto.js"></script>
</body>

</html>