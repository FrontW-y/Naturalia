<?php

require_once('../../Model/utilisateurClass.php');
$data;
if (isset($_COOKIE["token"])) {
    $user = Utilisateur::getCurrentUser();
    if ($user === null) {
        header("Location: ../html/connexion.php");
    }

    $data = $user->getSelfInfo();

} else {
    header("Location: ../html/connexion.php");
}





?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/header6.css" />
    <link rel="stylesheet" type="text/css" href="../css/profil.css" />
    <link rel="stylesheet" type="text/css" href="../css/ff.css" />


    <script src="../js/connexion.js"></script>
    <script src="../js/profil.js"></script>
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
                            <a href="../../Controleur/utilisateurController.php?action=deconnexion">Se déconnecter</a>
                        </div>
                        </div>
            </ul>
        </nav>
        <div class="feuille">
            <img src="../img/feuille.png" alt="" width="70" height="70">
        </div>

</header>

    <h1 class="sous-titre">Mon profil</h1>
    <br><br>
    <main>
        <div class="encadrement">
            <img class="imageprofil" src="../img/imageprofil.png" alt="" width="200" height="200">
        </div>
        <section>
            <form>
                <?php

                echo "<div class='form-group'>";
                echo "<label for='fname'>Prénom : </label>";
                echo "<input class='textarea' type='text' id='fname' name='fname' value='" . $data['fName'] . "'>";
                echo "<i onclick='modifiable()' class='fas'>&#xf304;</i><br><br>";
                echo "<label for='lname'>Nom : </label>";
                echo "<input class='textarea' type='text' id='lname' name='lname' value='" . $data['lName'] . "'>";
                echo "<i onclick='modifiable()' class='fas'>&#xf304;</i><br><br>";
                echo "<label for='username'>Nom d'utilisateur : </label>";
                echo "<input class='textarea' type='text' id='username' name='username' value='" . $data['username'] . "'>";
                echo "<i onclick='modifiable()' class='fas'>&#xf304;</i><br><br>";
                echo "<label for='login'>Login : </label>";
                echo "<input class='textarea' type='text' id='login' name='login' value='" . $data['email'] . "'>";
                echo "<i onclick='modifiable()' class='fas'>&#xf304;</i><br><br>";
                echo "<label for='birthdate'>Date de naissance : </label>";
                echo "<input class='textarea' type='date' id='birthdate' name='birthdate' value='" . $data['dateNaissance'] . "'>";
                echo "<i onclick='modifiable()' class='fas'>&#xf304;</i><br><br>";
                echo "<label for='login'>Date d'inscription : </label>";
                echo "<input class='textarea' type='text' id='login' name='login' value='" . $data['dateInscription'] . "'>";
                echo "<i onclick='modifiable()' class='fas'>&#xf304;</i><br><br>";
                echo "</div>";
                echo "<div class='bouttons'>";
                echo "<button onclick='modifiable()' class='enregistrer' type='submit'>Enregistrer</button>";
                echo "</div>";
                ?>
            </form>
        </section>
    </main>
    <br><br>
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