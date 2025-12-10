<?php
include 'db.php'; // connexion à la base

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $mot_de_passe = $_POST['motdepasse'];
    $confirmer = $_POST['confirmer'];
    $date_naissance = $_POST['date_naissance'];
    $sexe = $_POST['sexe'];
    $telephone = $_POST['telephone'];
    $pays = $_POST['pays'];
    $ville = $_POST['ville'];

    // Vérification mot de passe == confirmation
    if ($mot_de_passe !== $confirmer) {
        echo "<p style='color:red;'>❌ Les mots de passe ne correspondent pas !</p>";
        exit;
    }

    // Vérification complexité mot de passe
    if (!preg_match('/[A-Z]/', $mot_de_passe) ||       // au moins 1 majuscule
        !preg_match('/[\W]/', $mot_de_passe) ||       // au moins 1 caractère spécial
        strlen($mot_de_passe) < 7) {                  // au moins 7 caractères
        echo "<p style='color:red;'>❌ Le mot de passe doit contenir au moins 1 majuscule, 1 caractère spécial et 7 caractères minimum.</p>";
        exit;
    }

    // Hashage du mot de passe (plus besoin de sel séparé)
    $motdepasse_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    // Préparer la requête
    $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, date_naissance, sexe, telephone, pays, ville) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $nom, $prenom, $email, $motdepasse_hash, $date_naissance, $sexe, $telephone, $pays, $ville);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>✅ Inscription réussie ! Vous pouvez maintenant <a href='conexion.php'>vous connecter</a>.</p>";
    } else {
        echo "<p style='color:red;'>❌ Erreur SQL : " . $stmt->error . "</p>";
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
    <link rel="stylesheet" href="assets/style.css" />
    <title>Inscription - RideUp</title>
  </head>
  <body style="background-color: rgb(155, 244, 244); font-family: 'Segoe UI', sans-serif;">
    <header class="logo-container">
      <img src="image/ChatGPT Image 30 mai 2025, 20_16_23.png" alt="Logo de RideUp" class="logo-img" />
    </header>

    <main class="form-section">
      <h1 class="title">Rejoignez notre communauté de rideupers</h1>
      <h3 class="subtitle">Inscrivez-vous pour commencer à partager vos trajets domicile-école !</h3>

      <!-- IMPORTANT : ajouter method="POST" et name="..." -->
     <form class="form-card" action="inscription.php" method="POST">
        <input type="text" name="nom" placeholder="Nom " required />
        <input type="text" name="prenom" placeholder="Prénom" required />
        <input type="email" name="email" placeholder="Email Académique" required />
        <input type="password" name="motdepasse" placeholder="Mot de passe" id="password" required />
        <div id="passwordMessage" class="password-message">
  <p id="length" class="invalid">✔ 8 caractères minimum</p>
  <p id="uppercase" class="invalid">✔ 1 lettre majuscule</p>
  <p id="number" class="invalid">✔ 1 chiffre</p>
</div><style>
.password-message {
  font-size: 14px;
  margin-top: 5px;
}
.password-message p {
  margin: 0;
  padding: 3px;
}
.invalid {
  color: red;
}
.valid {
  color: green;
  font-weight: bold;
}
</style>

<script>
const passwordInput = document.getElementById("password");
const lengthCheck = document.getElementById("length");
const uppercaseCheck = document.getElementById("uppercase");
const numberCheck = document.getElementById("number");

passwordInput.addEventListener("input", () => {
  const value = passwordInput.value;

  // Longueur
  if (value.length >= 8) {
    lengthCheck.classList.remove("invalid");
    lengthCheck.classList.add("valid");
  } else {
    lengthCheck.classList.remove("valid");
    lengthCheck.classList.add("invalid");
  }

  // Majuscule
  if (/[A-Z]/.test(value)) {
    uppercaseCheck.classList.remove("invalid");
    uppercaseCheck.classList.add("valid");
  } else {
    uppercaseCheck.classList.remove("valid");
    uppercaseCheck.classList.add("invalid");
  }

  // Chiffre
  if (/[0-9]/.test(value)) {
    numberCheck.classList.remove("invalid");
    numberCheck.classList.add("valid");
  } else {
    numberCheck.classList.remove("valid");
    numberCheck.classList.add("invalid");
  }
});
</script>
        <input type="password" name="confirmer" placeholder="Confirmer le mot de passe" required />
        
        <label>Date de naissance</label>
        <input type="date" name="date_naissance" required />

        <div class="radio-group">
          <p>Choisissez votre sexe :</p>
          <label><input type="radio" name="sexe" value="masculin" required /> Masculin</label>
          <label><input type="radio" name="sexe" value="feminin" /> Féminin</label>
          <label><input type="radio" name="sexe" value="autre" /> Autre</label>
        </div>

        <input type="tel" name="telephone" placeholder="Numéro de téléphone" required />

        <label>Pays</label>
        <select name="pays" required>
          <option value="">-- Sélectionner un pays --</option>
          <option value="Canada">Canada</option>
          <option value="Etats-Unis">États-Unis</option>
        </select>

        <label>Ville</label>
        <select name="ville" required>
          <option value="">-- Sélectionner une ville --</option>
          <option value="Montreal">Montréal</option>
          <option value="Quebec">Québec</option>
          <option value="Toronto">Toronto</option>
        </select>

        <label>
          <input type="checkbox" id="terms" name="terms" required />
          J'ai lu et j'accepte les <a href="conditionU.html">conditions d'utilisation</a>
        </label>

        <button type="submit" class="btn">S'inscrire</button>
      </form>

      <div class="footer-links">
        <p>Vous avez déjà un compte ? <a href="conexion.php">Connectez-vous ici</a></p>
      </div>
    </main>
  </body>
</html>
