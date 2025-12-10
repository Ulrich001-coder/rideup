<?php
// Informations de connexion à MySQL
$host = "localhost"; // Serveur local (XAMPP)
$user = "root";      // Nom d'utilisateur par défaut sur XAMPP
$pass = "";          // Mot de passe vide par défaut sur XAMPP
$dbname = "rideup"; // ⚠️ Remplace par le nom exact de ta base

$conn = mysqli_connect($host, $user, $pass, $dbname);

try {
    // Connexion à MySQL avec PDO (plus sécurisé que mysqli)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

    // Activer le mode exception pour détecter les erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optionnel : afficher un message si connexion OK (à retirer en prod)
    // echo "Connexion réussie à la base de données !";
} 
catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>