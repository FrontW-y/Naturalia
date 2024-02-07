<?php require_once('../../Model/utilisateurClass.php');
$data;
if (isset($_COOKIE["token"])) {
  $user = Utilisateur::getCurrentUser();
  if ($user === null) {
    header("Location: ../html/connexion.php");
  }
  $data = $user->getFriend();
} else {
  header("Location: ../html/connexion.php");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Système d'amis</title>
  <link rel="stylesheet" href="../css/friend1.css">
  <link rel="stylesheet" href="../css/header6.css">
  <link rel="stylesheet" href="../css/ff.css">
  <script src='../js/connexion.js'></script>  
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


  <CENTER>
    <h2>Mes Amis</h2>
  </CENTER>

  <form class="search-add-friend" method="post" action="../../Controleur/utilisateurController.php?action=ajouterAmi">
    <input type="text" name="friend" id="searchFriendInput" placeholder="Ajouter un ami ">
  </form>
  <br>

  <?php

  if (empty($data)) {
    echo "<p>Vous n'avez pas d'amis</p>";
  } else {
    echo "<ul class='friend-container'>";
    foreach ($data as $friend) {
      $id = $friend["UUID"];
      echo "<li class='friend-card'>";
      echo "<div class='encadrement'>";
      echo "<img class='imageprofil' src='../img/imageprofil.png' alt='' width='110' height='110'>";
      echo "</div>";
      echo "<div class='friend-info'>";
      echo "<h2>" . $friend["username"] . "</h2>";
      echo "<button class='view-libraries-button' onclick=\"window.location.href='./listePostAmi.php?id=$id'\">Afficher les postes</button>";
      echo "</div>";
      echo "</li>";
    }

  }
  ?>
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