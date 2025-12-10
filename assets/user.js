
document.addEventListener('DOMContentLoaded', () => {

   
    // Définition de la classe de base pour un utilisateur
    class Utilisateur {
        constructor(nom, email, motDePasse, telephone) {
            this.nomComplet = nom;
            this.emailAcademique = email;
            this.motDePasse = motDePasse;
            this.numeroTelephone = telephone;
        }
    }

    // Définition de la classe Chauffeur qui hérite d'Utilisateur
    class Chauffeur extends Utilisateur {
        constructor(nom, email, motDePasse, telephone, voiture, plaque, capacite) {
            // Utilisation de super() pour appeler le constructeur de la classe parente
            super(nom, email, motDePasse, telephone);
            this.modeleVoiture = voiture;
            this.plaqueImmatriculation = plaque;
            this.capaciteVehicule = capacite;
        }
    }

    // Fonction de gestion de la soumission du formulaire d'inscription
    function gererInscriptionChauffeur(e) {
        e.preventDefault(); // Empêche la page de se recharger

        // Récupération des valeurs des champs du formulaire
        const nom = document.getElementById('nomComplet').value;
        const email = document.getElementById('emailAcademique').value;
        const motDePasse = document.getElementById('motDePasse').value;
        const telephone = document.getElementById('telephone').value;
        const voiture = document.getElementById('modeleVoiture').value;
        const plaque = document.getElementById('plaqueImmatriculation').value;
        const capacite = document.getElementById('capaciteVehicule').value;

        if (nom && email && motDePasse && telephone && voiture && plaque && capacite) {
            // Création d'un nouvel objet Chauffeur
            const nouveauChauffeur = new Chauffeur(nom, email, motDePasse, telephone, voiture, plaque, capacite);
            alert(`Inscription réussie pour ${nouveauChauffeur.nomComplet} 
                                      email:${nouveauChauffeur.emailAcademique}
                                      telephone: ${nouveauChauffeur.numeroTelephone}
                                        voiture: ${nouveauChauffeur.modeleVoiture}
                                        plaque: ${nouveauChauffeur.plaqueImmatriculation}
                                        capacité: ${nouveauChauffeur.capaciteVehicule } `);
            document.getElementById('formulaireChauffeur').reset();
        } else {
            alert("Veuillez remplir tous les champs obligatoires du formulaire d'inscription.");
        }
    }

    // Association de la fonction à l'événement 'submit' du formulaire
    document.getElementById('formulaireChauffeur').addEventListener('submit', gererInscriptionChauffeur);

   

    // Fonction de gestion du calcul de coût de trajet
    function gererCalculateurDeCout(e) {
        e.preventDefault();

        const distance = parseFloat(document.getElementById('distanceTrajet').value);
        const coutEssence = parseFloat(document.getElementById('coutEssence').value);
        const consoVoiture = parseFloat(document.getElementById('consoVoiture').value);
        const resultatDiv = document.getElementById('resultatCalcul');

        if (isNaN(distance) || isNaN(coutEssence) || isNaN(consoVoiture) || distance <= 0 || coutEssence <= 0 || consoVoiture <= 0) {
            resultatDiv.innerHTML = "Veuillez entrer des valeurs numériques valides et positives.";//
            return;
        }

        const coutTotal = (distance / 100) * consoVoiture * coutEssence;
        const commission = 0.15;
        const profitNet = coutTotal * (1 - commission);

        resultatDiv.innerHTML = `
            Le coût estimé de votre trajet est de **${coutTotal.toFixed(2)}$**.
            Votre gain net après commission serait d'environ **${profitNet.toFixed(2)}$**.
        `;
    }

    document.getElementById('formulaireCalculatrice').addEventListener('submit', gererCalculateurDeCout);

    

    // Fonction de gestion des opérations mathématiques
    function gererCalculatriceMathematique() {
        const nombre1 = parseFloat(document.getElementById('nombre1').value);
        const nombre2 = parseFloat(document.getElementById('nombre2').value);
        const operateur = document.getElementById('operateur').value;
        const resultatOperationDiv = document.getElementById('resultatOperation');
        let resultat;
        let description;

        if (isNaN(nombre1) || isNaN(nombre2)) {
            resultatOperationDiv.innerHTML = `Veuillez entrer des nombres valides.`;
            return;
        }

        // Utilisation d'une structure conditionnelle (switch)
        switch (operateur) {
            case '+':
                resultat = nombre1 + nombre2;
                description = `(Ex: Somme de vos revenus)`;
                break;
            case '-':
                resultat = nombre1 - nombre2;
                description = `(Ex: Retrait de vos dépenses)`;
                break;
            case '*':
                resultat = nombre1 * nombre2;
                description = `(Ex: Total de passagers)`;
                break;
            case '/':
                if (nombre2 === 0) {
                    resultatOperationDiv.innerHTML = `Erreur: Division par zéro.`;
                    return;
                }
                resultat = nombre1 / nombre2;
                description = `(Ex: Gain moyen par passager)`;
                break;
            default:
                resultatOperationDiv.innerHTML = `Opérateur non valide.`;
                return;
        }

        resultatOperationDiv.innerHTML = `Le résultat est **${resultat.toFixed(2)}** ${description}.`;
    }

    document.getElementById('btnOperation').addEventListener('click', gererCalculatriceMathematique);


    // Déclaration d'un tableau pour les passagers.
    // La portée globale de cette variable lui permet d'être accessible par toutes les fonctions.
    let passagers = ["Alice", "Bob", "Charlie"];

    // Récupération des éléments du DOM
    const listePassagers = document.getElementById('listePassagers');
    const btnAjouter = document.getElementById('btnAjouter');
    const btnRetirer = document.getElementById('btnRetirer');

    // Fonction pour mettre à jour l'affichage de la liste
    function afficherListePassagers() {
        listePassagers.innerHTML = "";
        passagers.forEach(passager => {
            const li = document.createElement("li");
            li.textContent = passager;
            listePassagers.appendChild(li);
        });
    }

    // Fonction pour ajouter un passager
    function ajouterPassager() {
        const nouveauPassager = prompt("Entrez le nom du nouveau passager :");
        if (nouveauPassager) {
            passagers.push(nouveauPassager); // Utilisation de la méthode push()
            afficherListePassagers();
        }
    }

    // Fonction pour retirer le dernier passager
    function retirerPassager() {
        if (passagers.length > 0) {
            passagers.pop(); // Utilisation de la méthode pop()
            afficherListePassagers();
        } else {
            alert("Il n'y a plus de passagers à retirer.");
        }
    }

    // Association des fonctions aux événements 'click' des boutons
    btnAjouter.addEventListener('click', ajouterPassager);
    btnRetirer.addEventListener('click', retirerPassager);

    // Affichage de la liste initiale des passagers au chargement de la page
    afficherListePassagers();
});