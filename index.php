<?php
include 'db.php';

if ($conn) {
    echo " Connexion à la base réussie !";

    // Exemple : compter les utilisateurs
    $sql = "SELECT COUNT(*) AS total FROM users";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalUsers = $row['total'];
    } else {
        $totalUsers = 0;
    }
} else {
    echo " Échec de la connexion : " . mysqli_connect_error();
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/style.css" />
    <title>RideUp Accueil</title>
  </head>
  <body>
    <header class="site-header">
      <div class="logo-container">
        <img
          src="image/ChatGPT Image 30 mai 2025, 20_16_23.png"
          alt="Logo de RideUp"
          class="logo-img"
        />
      </div>
    </header>

    <main class="hero container">
      <h1>Bienvenue sur RideUp</h1>
      <h3>La plateforme de covoiturage pour les trajets domicile-école</h3>
      <p> Déjà <strong><?php echo $totalUsers; ?></strong> utilisateurs inscrits !</p>
      <div class="btn-group">
        <button class="btn" onclick="location.href='inscription.php'">
          Inscription
        </button>
        <button class="btn" onclick="location.href='conexion.php'">
          Connexion
        </button>
      </div>
    </main>

    <div class="notice">
       Astuce : Créez votre profil pour bénéficier des trajets partagés !
    </div>

    <footer class="site-footer">
      &copy; 2025 RideUp - Tous droits réservés
      <div class="footer-links">
        <a href="A propos.html">Qui sommes-nous ?</a><br />
        <a href="inscriptionchauffeur.html">Vous êtes chauffeur ? Cliquez ici</a>
      </div>
    </footer>
  </body>
</html>