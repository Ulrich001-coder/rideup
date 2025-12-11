📘 RideUp - Plateforme de Covoiturage Scolaire

📋 Table des Matières
🚀 Présentation

🎯 Fonctionnalités

👥 Équipe

🛠️ Installation

🏗️ Architecture

🔒 Sécurité

📁 Structure du Projet

🧪 Tests

🚀 Déploiement

🤝 Contribution

📄 Licence

📞 Contact

🚀 Présentation
RideUp est une plateforme web de covoiturage spécialisée pour les étudiants. L'application permet aux étudiants conducteurs de partager leurs trajets domicile-école avec d'autres étudiants, réduisant ainsi les coûts de transport et favorisant une mobilité durable.

🎯 Objectifs
✅ Réduire les frais de transport des étudiants

✅ Faciliter les déplacements domicile-école

✅ Promouvoir le covoiturage écologique

✅ Créer une communauté étudiante sécurisée

🎯 Fonctionnalités
Pour les Utilisateurs
👤 Inscription/Connexion sécurisée

Validation des emails académiques

Mots de passe sécurisés avec hashage bcrypt

Sessions PHP protégées

📱 Tableau de Bord Personnel

Vue d'ensemble du profil

Modification des informations personnelles

Navigation intuitive

🚗 Inscription Chauffeur

Formulaire spécifique pour les conducteurs

Calculateur de coût de trajet intégré

Gestion des informations véhicule

Pour les Administrateurs
🔐 Gestion des sessions

🗄️ Base de données MySQL

📊 Tableau de bord utilisateurs

👥 Équipe
Membre	Rôle	Technologies	Responsabilités
Caleb	Designer UI/UX	HTML, CSS, JavaScript	Design, Interface utilisateur, Expérience utilisateur
Lele	Backend & Sécurité	PHP, MySQL, Sécurité	Base de données, Authentification, Sécurité, API
Arthur	Développeur Full-Stack	PHP, HTML, JavaScript	Fonctionnalités, Tableau de bord, Documentation
🛠️ Installation
Prérequis
XAMPP (Apache, MySQL, PHP)

PHP 7.4 ou supérieur

MySQL 5.7 ou supérieur

Navigateur web moderne

Étapes d'installation
Télécharger et installer XAMPP

bash
# Téléchargez XAMPP depuis le site officiel
# Installez-le dans C:\xampp\ (Windows) ou /Applications/XAMPP/ (Mac)
Cloner le projet

bash
git clone https://github.com/votre-username/rideup.git
Déplacer le projet

text
Copiez le dossier rideup dans : C:\xampp\htdocs\
Démarrer les services

Lancez le panneau de contrôle XAMPP

Démarrez Apache et MySQL

Créer la base de données

sql
-- Ouvrez phpMyAdmin (http://localhost/phpmyadmin)
-- Créez une nouvelle base de données nommée 'rideup'
-- Exécutez ce script SQL :

CREATE DATABASE rideup;
USE rideup;

CREATE TABLE utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_naissance DATE NOT NULL,
    sexe ENUM('masculin', 'feminin', 'autre') NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    pays VARCHAR(50) NOT NULL,
    ville VARCHAR(50) NOT NULL,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
Configurer la connexion

php
// db.php est déjà configuré pour XAMPP par défaut
// Vérifiez les paramètres si nécessaire :
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "rideup";
Accéder à l'application

text
Ouvrez votre navigateur et allez sur : http://localhost/rideup/
Configuration rapide avec Docker (Optionnel)
bash
# Clonez le projet
git clone https://github.com/votre-username/rideup.git
cd rideup

# Créez un fichier docker-compose.yml
# Lancez les conteneurs
docker-compose up -d

# Accédez à l'application
http://localhost:8080
🏗️ Architecture
Stack Technologique
text
Frontend:
├── HTML5 (Structure)
├── CSS3 (Style avec animations)
└── JavaScript (Interactivité)

Backend:
├── PHP 7.4+ (Logique métier)
├── MySQL 5.7+ (Base de données)
└── Apache (Serveur web)

Sécurité:
├── Sessions PHP
├── Password Hash (bcrypt)
└── Requêtes préparées PDO
Diagramme d'architecture

















🔒 Sécurité
Mesures de sécurité implémentées
Authentification sécurisée

php
// Hashage des mots de passe avec bcrypt
$motdepasse_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Vérification sécurisée
if (password_verify($mot_de_passe, $motdepasse_hash)) {
    // Authentification réussie
}
Protection contre les injections SQL

php
// Utilisation de requêtes préparées PDO
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
$stmt->execute([$email]);
Gestion des sessions

php
session_start();
// Validation des sessions
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: conexion.php");
    exit();
}
Validation des entrées

php
// Validation côté serveur
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erreurs[] = "Email invalide";
}

// Validation des mots de passe
if (strlen($mot_de_passe) < 7 || 
    !preg_match('/[A-Z]/', $mot_de_passe) || 
    !preg_match('/[\W]/', $mot_de_passe)) {
    $erreurs[] = "Mot de passe trop faible";
}
Protection XSS

php
// Échappement des sorties HTML
echo htmlspecialchars($donnee_utilisateur, ENT_QUOTES, 'UTF-8');
📁 Structure du Projet
text
rideup/
│
├── 📁 assets/                 # Fichiers statiques
│   └── style.css             # Feuille de style principale
│
├── 📁 image/                  # Images et médias
│   └──  Image 30 mai 2025, 20_16_23.png
│
├── 📄 index.php               # Page d'accueil
├── 📄 db.php                  # Configuration base de données
├── 📄 conexion.php            # Connexion utilisateur
├── 📄 inscription.php         # Inscription utilisateur
├── 📄 board.php               # Tableau de bord
├── 📄 modifier_profil.php     # Modification du profil
│
├── 📄 inscriptionchauffeur.html # Inscription chauffeur
├── 📄 conditionU.html         # Conditions d'utilisation
├── 📄 A propos.html           # Page À propos
│
├── 📁 docs/                   # Documentation (optionnel)
│   ├── database_schema.sql    # Schéma base de données
│   ├── api_documentation.md   # Documentation API
│   └── user_guide.md          # Guide utilisateur
│
└── 📄 README.md               # Ce fichier
Description des fichiers principaux
Fichier	Description	Responsable
db.php	Configuration de la connexion à MySQL avec PDO et MySQLi	Lele
inscription.php	Formulaire d'inscription avec validation complète	Lele
conexion.php	Système d'authentification sécurisé	Lele
board.php	Tableau de bord utilisateur avec sections dynamiques	Arthur
style.css	Styles CSS pour l'ensemble du site	Caleb
inscriptionchauffeur.html	Page spécifique pour les chauffeurs	Caleb/Arthur
🧪 Tests
Scénarios de test manuels
Test d'inscription

text
URL: http://localhost/rideup/inscription.php
Action: Remplir le formulaire avec des données valides
Résultat attendu: Message de succès et redirection possible
Test de connexion

text
URL: http://localhost/rideup/conexion.php
Action: Utiliser les identifiants créés
Résultat attendu: Accès au tableau de bord
Test de sécurité

text
URL: http://localhost/rideup/conexion.php
Action: Tentative d'injection SQL
Résultat attendu: Échec de l'authentification
Test responsive

text
Action: Redimensionner la fenêtre du navigateur
Résultat attendu: Interface s'adapte correctement
Liste des tests à automatiser
Tests unitaires PHP

Tests d'intégration base de données

Tests de sécurité

Tests de performance

🚀 Déploiement
Environnement de production recommandé
Serveur Web

bash
# Ubuntu/Debian
sudo apt update
sudo apt install apache2 mysql-server php libapache2-mod-php php-mysql
Configuration Apache

apache
<VirtualHost *:80>
    ServerName rideup.com
    DocumentRoot /var/www/rideup
    
    <Directory /var/www/rideup>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/rideup_error.log
    CustomLog ${APACHE_LOG_DIR}/rideup_access.log combined
</VirtualHost>
Sécurité production

bash
# Activer HTTPS avec Let's Encrypt
sudo apt install certbot python3-certbot-apache
sudo certbot --apache -d rideup.com

# Configurer les permissions
sudo chown -R www-data:www-data /var/www/rideup
sudo chmod -R 755 /var/www/rideup
Optimisations PHP

php
// php.ini production
display_errors = Off
log_errors = On
error_log = /var/log/php/errors.log
upload_max_filesize = 10M
post_max_size = 12M
🤝 Contribution
Guide de contribution
Fork du projet

bash
# Fork le projet sur GitHub
# Clonez votre fork localement
git clone https://github.com/votre-username/rideup.git
cd rideup
Créer une branche

bash
git checkout -b feature/nouvelle-fonctionnalite
Conventions de code

php
// PHP - PSR-12
function nomDeLaFonction($parametre)
{
    // Logique
}

// Variables en camelCase
$nomUtilisateur = "John";

// Commentaires en français
/**
 * Cette fonction fait quelque chose
 * @param string $param Description
 * @return bool Résultat
 */
Commit des changements

bash
git add .
git commit -m "feat: ajout nouvelle fonctionnalité"
git push origin feature/nouvelle-fonctionnalite
Pull Request

Créez une PR sur GitHub

Décrivez vos changements

Référencez les issues concernées

Standards de développement
Type	Convention	Exemple
Branches	feature/, bugfix/, hotfix/	feature/recherche-trajet
Commits	Conventional Commits	feat:, fix:, docs:, style:
PHP	PSR-12, PHPDoc	/** @var Type $var */
CSS	BEM methodology	.form-card__title
SQL	snake_case, majuscules	SELECT * FROM utilisateurs
📄 Licence
Ce projet est sous licence MIT.

text
MIT License

Copyright (c) 2025 RideUp Team

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
📞 Contact
Équipe de développement
Membre	Rôle	Contact
Caleb	Designer UI/UX	caleb.design@rideup.com
Lele	Backend & Sécurité	lele.dev@rideup.com
Arthur	Développeur Fonctionnalités	arthur.dev@rideup.com
Support
Email : support@rideup.com

Issues : GitHub Issues

Documentation : Consultez le dossier /docs/

Suivi du projet
📅 Date de début : Mai 2025

🎯 Version actuelle : 1.0.0 (MVP)

📊 Statut : En développement actif

🌟 Étoiles et Support
Si ce projet vous est utile, pensez à :

⭐ Mettre une étoile sur GitHub

🔄 Partager avec d'autres étudiants

🐛 Signaler les bugs via Issues

💡 Proposer des améliorations

<div align="center">
✨ Développé avec passion par l'équipe RideUp ✨
Caleb • Lele • Arthur

🚗 "Votre trajet, notre connexion" 🚗



</div>
