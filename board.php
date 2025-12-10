<?php
session_start();
include 'db.php';

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

// Récupérer les informations de l'utilisateur
$id_utilisateur = $_SESSION['id_utilisateur'];
$sql = "SELECT nom, prenom, email, telephone, date_naissance, sexe, pays, ville FROM utilisateurs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_utilisateur);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $utilisateur = $result->fetch_assoc();
} else {
    echo "Erreur: Utilisateur non trouvé.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tableau de Bord - RideUp</title>
    <link rel="stylesheet" href="assets/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body class="dashboard-body">

    <header class="dashboard-header">
        <div class="logo-container">
            <img src="image/ChatGPT Image 30 mai 2025, 20_16_23.png" alt="Logo de RideUp" class="logo-img" />
        </div>
        <div class="header-content">
            <h1 class="title">Bienvenue, <?php echo htmlspecialchars($utilisateur['prenom']); ?></h1>
            <p class="subtitle">Trouvez votre prochain trajet scolaire !</p>
        </div>
        <div class="user-menu-container">
            <div class="user-menu-button" onclick="toggleMenu()">
                <span><?php echo htmlspecialchars(substr($utilisateur['prenom'], 0, 1)); ?></span>
            </div>
            <div class="user-menu" id="userMenu">
                <a href="#profil" onclick="showSection('profil'); toggleMenu()">Mon Profil</a>
                <a href="#historique" onclick="showSection('historique'); toggleMenu()">Historique</a>
                <a href="deconnexion.php">Déconnexion</a>
            </div>
        </div>
    </header>
    
    <nav class="dashboard-nav">
        <a href="index.php">Accueil</a>
        <a href="#recherche" onclick="showSection('recherche')">Rechercher un trajet</a>
        <a href="publier.php">Publier un trajet</a>
    </nav>

    <main class="main-content">
      <section id="profil" class="dashboard-section active">
    <h2>Mon Profil</h2>
    <div class="profile-info">
        <p><strong>Nom :</strong> <?php echo htmlspecialchars($utilisateur['nom']); ?></p>
        <p><strong>Prénom :</strong> <?php echo htmlspecialchars($utilisateur['prenom']); ?></p>
        <p><strong>Email :</strong> <?php echo htmlspecialchars($utilisateur['email']); ?></p>
        <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($utilisateur['telephone']); ?></p>
        <p><strong>Date de naissance :</strong> <?php echo htmlspecialchars($utilisateur['date_naissance']); ?></p>
        <p><strong>Sexe :</strong> <?php echo htmlspecialchars($utilisateur['sexe']); ?></p>
        <p><strong>Pays :</strong> <?php echo htmlspecialchars($utilisateur['pays']); ?></p>
        <p><strong>Ville :</strong> <?php echo htmlspecialchars($utilisateur['ville']); ?></p>
    </div>
    <div style="text-align:center; margin-top:20px;background-color: #007BFF; padding: 10px; border-radius: 5px; width: 200px; margin-left: auto; margin-right: auto;">
        <a href="modifier_profil.php" >Modifier mon profil</a>
    </div>
</section>

        <section id="historique" class="dashboard-section" style="display:none;">
            <h2>Historique de mes trajets</h2>
            <p>Cet espace est en cours de développement. Il affichera bientôt vos trajets passés et à venir.</p>
        </section>

        <section id="recherche" class="dashboard-section" style="display:none;">
            <h2>Rechercher un trajet</h2>
            <form class="search-form">
                <label for="destination">École/Université d'arrivée</label>
                <input type="text" id="destination" name="destination" placeholder="Ex: Cégep du Vieux Montréal" required>
                
                <label for="date_trajet">Date du trajet</label>
                <input type="date" id="date_trajet" name="date_trajet" required>
                
                <button type="submit" class="btn">Rechercher un trajet</button>
            </form>
        </section>
    </main>

    <footer class="site-footer">
        <p>&copy; 2025 RideUp. Tous droits réservés.</p>
    </footer>

    <script>
        function showSection(id) {
            document.querySelectorAll('.dashboard-section').forEach(section => {
                section.style.display = 'none';
                section.classList.remove('active');
            });
            const sectionToShow = document.getElementById(id);
            if (sectionToShow) {
                sectionToShow.style.display = 'block';
                setTimeout(() => sectionToShow.classList.add('active'), 10);
            }
        }

        function toggleMenu() {
            const menu = document.getElementById('userMenu');
            menu.classList.toggle('show');
        }

        document.addEventListener('DOMContentLoaded', () => {
            showSection('recherche');
        });
    </script>
</body>
</html>