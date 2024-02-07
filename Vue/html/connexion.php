<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/connexion2.css" />
    <link rel="stylesheet" href="../css/header3.css">
    <link rel="stylesheet" type="text/css" href="../css/ff.css" />
    <script src="../js/connexion.js"></script>
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

    <div class="message">
        <h2>Bienvenue à nouveau !</h2>
        <p>Pour rester en contact avec nous, veuillez vous connecter avec vos informations personnelles.</p>
    </div>
    <div class=corps>
        <form method="post" action="../../Controleur/utilisateurController.php?action=connexion">
            <div class="form-container">
                <h1>Se connecter</h1>
                <?php if (!empty($_SESSION['CONNEXION_ERROR'])): ?>
                    <p style="color: red;">
                        <?php echo $_SESSION['CONNEXION_ERROR'];
                        unset($_SESSION['CONNEXION_ERROR']); ?>
                    </p>
                <?php endif; ?>
                <div class="inputs">
                    <input type="email" name="email" for="email" placeholder="Email" />
                    <input type="password" name="password" for="password" placeholder="Mot de passe">
                </div>

                <a href="../html/mdp.html" class="mdp" target="_blank">Mot de passe oublié ?</a>
                <p class="inscription">Je n'ai pas de <span>compte</span>. Je m'en <span><a href="../html/inscription.html">crée</a></span> un.</p>
                <div align="center">
                    <button type="submit">Se connecter</button>
                </div>
            </div>
        </form>

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
</body>

</html>