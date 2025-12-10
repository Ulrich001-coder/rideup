<?php
session_start(); // Démarre la session PHP
include 'db.php'; // Connexion à la base de données

$erreur_message = ""; // Variable pour stocker les messages d'erreur

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $mot_de_passe = $_POST['motdepasse'];

    // Préparation de la requête pour trouver l'utilisateur par son email
    $sql = "SELECT id, mot_de_passe FROM utilisateurs WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id_utilisateur, $motdepasse_hash);
    $stmt->fetch();

    // Vérification de l'existence de l'utilisateur
    if ($stmt->num_rows == 1) {
        // L'utilisateur existe, vérifions le mot de passe
        if (password_verify($mot_de_passe, $motdepasse_hash)) {
            // Mot de passe correct, on démarre la session
            $_SESSION['id_utilisateur'] = $id_utilisateur;
            header("Location: board.php"); // Redirection vers la page du tableau de bord
            exit;
        } else {
            // Mot de passe incorrect
            $erreur_message = "❌ adresse mail ou mot de passe incorrect.";
        }
    } else {
        // Utilisateur non trouvé
        $erreur_message = "❌ adresse mail ou mot de passe incorrect.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion - RideUp</title>
    <link rel="stylesheet" href="assets/style.css" />
  </head>
  <body>
    <div class="form-container">
      <img
        src="image/ChatGPT Image 30 mai 2025, 20_16_23.png"
        alt="Logo de RideUp"
        class="logo-img animate"
      />

      <div class="form-card animate">
        <h1 class="title">Connexion à RideUp</h1>
        <p class="subtitle">
          Connectez-vous pour partager vos trajets domicile-école !
        </p>

        <?php if (!empty($erreur_message)) : ?>
            <p style='color:red; text-align:center;'><?php echo $erreur_message; ?></p>
        <?php endif; ?>

        <form action="conexion.php" method="POST">
          <input type="email" name="email" placeholder="Email académique" required />
          <input type="password" name="motdepasse" placeholder="Mot de passe" required />

          <button type="submit" class="btn">Se connecter</button>
        </form>

        <p class="login-link">
          Vous n'avez pas de compte ?
          <a href="inscription.php">Inscrivez-vous ici</a>
        </p>
      </div>
    </div>
  </body>
</html>