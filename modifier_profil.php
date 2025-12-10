<?php
session_start();
include 'db.php';

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

$id_utilisateur = $_SESSION['id_utilisateur'];

// Traitement du formulaire de mise à jour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $telephone = $_POST['telephone'];
    $pays = $_POST['pays'];
    $ville = $_POST['ville'];
    
    // Requête préparée pour la mise à jour des informations
    $sql = "UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?, telephone = ?, pays = ?, ville = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nom, $prenom, $email, $telephone, $pays, $ville, $id_utilisateur);

    if ($stmt->execute()) {
        $message_succes = "✅ Profil mis à jour avec succès !";
    } else {
        $message_erreur = "❌ Erreur lors de la mise à jour : " . $stmt->error;
    }
    
    $stmt->close();
}

// Récupération des informations de l'utilisateur pour pré-remplir le formulaire
$sql = "SELECT nom, prenom, email, telephone, date_naissance, sexe, pays, ville FROM utilisateurs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_utilisateur);
$stmt->execute();
$result = $stmt->get_result();
$utilisateur = $result->fetch_assoc();
$stmt->close();
$conn->close();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modifier le Profil - RideUp</title>
    <link rel="stylesheet" href="assets/style.css" />
</head>
<body style="background-color: rgb(155, 244, 244); font-family: 'Segoe UI', sans-serif;">
    <header class="logo-container">
        <img src="image/ChatGPT Image 30 mai 2025, 20_16_23.png" alt="Logo de RideUp" class="logo-img" />
    </header>

    <main class="form-section">
        <h1 class="title">Modifier mes informations</h1>
        <h3 class="subtitle">Mettez à jour votre profil RideUp</h3>

        <?php if (isset($message_succes)) : ?>
            <p style='color:green; text-align:center;'><?php echo $message_succes; ?></p>
        <?php endif; ?>
        <?php if (isset($message_erreur)) : ?>
            <p style='color:red; text-align:center;'><?php echo $message_erreur; ?></p>
        <?php endif; ?>

        <form class="form-card" action="modifier_profil.php" method="POST">
            <input type="text" name="nom" placeholder="Nom" value="<?php echo htmlspecialchars($utilisateur['nom']); ?>" required />
            <input type="text" name="prenom" placeholder="Prénom" value="<?php echo htmlspecialchars($utilisateur['prenom']); ?>" required />
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($utilisateur['email']); ?>" required />
            <input type="tel" name="telephone" placeholder="Numéro de téléphone" value="<?php echo htmlspecialchars($utilisateur['telephone']); ?>" required />
            
            <label>Pays</label>
            <select name="pays" required>
                <option value="Canada" <?php echo ($utilisateur['pays'] == 'Canada') ? 'selected' : ''; ?>>Canada</option>
                <option value="Etats-Unis" <?php echo ($utilisateur['pays'] == 'Etats-Unis') ? 'selected' : ''; ?>>États-Unis</option>
            </select>

            <label>Ville</label>
            <select name="ville" required>
                <option value="Montreal" <?php echo ($utilisateur['ville'] == 'Montreal') ? 'selected' : ''; ?>>Montréal</option>
                <option value="Quebec" <?php echo ($utilisateur['ville'] == 'Quebec') ? 'selected' : ''; ?>>Québec</option>
                <option value="Toronto" <?php echo ($utilisateur['ville'] == 'Toronto') ? 'selected' : ''; ?>>Toronto</option>
            </select>

            <button type="submit" class="btn">Enregistrer les modifications</button>
        </form>

        <div class="footer-links">
            <a href="board.php">Retour au tableau de bord</a>
        </div>
    </main>
</body>
</html>