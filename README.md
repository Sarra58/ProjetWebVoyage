# 📅 Projet Web - Gestion des Événements

Ce projet est une application web de gestion des événements développée selon le modèle **MVC (Modèle-Vue-Contrôleur)**. Il permet d'ajouter, modifier, supprimer, afficher et rechercher des événements.

## 🚀 Fonctionnalités

- Ajouter un nouvel événement avec photo
- Modifier les informations d’un événement
- Supprimer un événement
- Lister tous les événements
- Rechercher un événement par titre ou lieu
- Trier les événements par date
- Afficher les détails d’un événement

## 🧱 Structure du projet (MVC)
/project-root │ ├── /model │ └── Evenement.php # Classe représentant l'entité événement (id, photo, titre, etc.) │ ├── /controller │ └── EvenementController.php # Gère les requêtes et appelle les méthodes du modèle │ ├── /view │ ├── evenement/ │ │ ├── liste.php # Affichage de tous les événements │ │ ├── ajout.php # Formulaire d’ajout │ │ ├── modification.php # Formulaire de modification │ │ └── details.php # Détails d’un événement │ ├── /uploads # Contient les photos uploadées │ ├── index.php # Point d’entrée du site (routeur) └── config.php # Configuration (BD, constantes, etc.)
## 🗃️ Modèle de données : `Evenement`

| Attribut     | Type       | Description                        |
|--------------|------------|------------------------------------|
| id           | int        | Identifiant unique de l’événement |
| photo        | string     | Nom du fichier photo (upload)     |
| titre        | string     | Titre de l’événement              |
| description  | text       | Description de l’événement        |
| dateDebut    | date       | Date de début                     |
| dateFin      | date       | Date de fin                       |
| lieu         | string     | Lieu de l’événement               |

## 💻 Technologies utilisées

- PHP (POO)
- HTML/CSS
- JavaScript
- MySQL
- Architecture MVC personnalisée
1. Cloner le dépôt :
   ```bash
   git clone https://github.com/votre-utilisateur/gestion-evenements-mvc.git
Importer le fichier database.sql dans votre base de données MySQL.

Configurer les identifiants de la base de données dans config.php.

S’assurer que le dossier /uploads est accessible en écriture.

Lancer l'application via un serveur local (XAMPP, WAMP, etc.).
