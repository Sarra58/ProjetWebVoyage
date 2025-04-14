# 🌍 Tripster - Gestion d'Agence de Voyages

Tripster est une application web moderne pour la gestion d'une agence de voyages. Elle offre une interface intuitive pour gérer les réservations, les destinations, et les clients, avec un accent particulier sur l'expérience utilisateur.

## 🎯 Fonctionnalités Principales

- **Gestion des Destinations**
  - Catalogue complet des destinations disponibles
  - Filtrage par catégorie (Plage, Montagne, Culture, etc.)
  - Détails complets avec images et descriptions
  - Prix par jour et disponibilité

- **Système de Réservation**
  - Formulaire de réservation intuitif
  - Sélection de dates avec validation
  - Calcul automatique du prix total
  - Confirmation par email

- **Gestion des Clients**
  - Espace client personnel
  - Historique des réservations
  - Possibilité de modification/annulation
  - Recherche par email

- **Interface Admin**
  - Gestion complète des offres
  - Ajout/modification de destinations
  - Suivi des réservations
  - Tableau de bord statistique

## 🛠️ Technologies Utilisées

- **Front-end**
  - HTML5 & CSS3
  - Bootstrap 4 pour le design responsive
  - JavaScript pour les interactions
  - Font Awesome pour les icônes

- **Back-end**
  - PHP 7.4+
  - Architecture MVC (Modèle-Vue-Contrôleur)
  - PDO pour la sécurité des requêtes SQL
  - Sessions PHP pour l'authentification

- **Base de Données**
  - MySQL
  - Structure relationnelle optimisée
  - Tables principales : destinations, voyages, réservations

- **Environnement de Développement**
  - XAMPP (Apache, MySQL, PHP)
  - phpMyAdmin pour la gestion de la base de données

## ⚙️ Installation

1. **Prérequis**
   - XAMPP installé et configuré
   - PHP 7.4 ou supérieur
   - MySQL 5.7 ou supérieur
   - Composer (optionnel pour les dépendances)

2. **Configuration**
   ```bash
   # Clonez le dépôt
   git clone https://github.com/Sarra58/ProjetWebVoyage.git
   
   # Placez le projet dans le dossier htdocs de XAMPP
   mv ProjetWebVoyage /path/to/xampp/htdocs/tripster
   ```

3. **Base de Données**
   - Démarrez XAMPP (Apache et MySQL)
   - Accédez à phpMyAdmin (http://localhost/phpmyadmin)
   - Créez une nouvelle base de données : `tripster`
   - Importez le fichier `database/tripster.sql`

4. **Configuration de la Base de Données**
   - Modifiez le fichier `config.php` avec vos paramètres :
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'tripster');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```

## 🚀 Utilisation

1. **Accès à l'Application**
   - Front-office : http://localhost/tripster/view/frontoffice/
   - Back-office : http://localhost/tripster/view/backoffice/

2. **Fonctionnalités Clés**
   - **Pour les Clients**
     - Consultation des destinations
     - Réservation en ligne
     - Gestion de ses voyages
     - Modification des réservations

   - **Pour les Administrateurs**
     - Gestion complète du catalogue
     - Suivi des réservations
     - Statistiques de ventes
     - Gestion des utilisateurs

## 📁 Structure du Projet

```
tripster/
├── controller/         # Contrôleurs MVC
├── Model/             # Modèles de données
├── view/
│   ├── frontoffice/   # Interface client
│   └── backoffice/    # Interface admin
├── config.php         # Configuration
└── database/          # Scripts SQL
```

## 🔒 Sécurité

- Protection contre les injections SQL
- Validation des entrées utilisateur
- Gestion sécurisée des sessions
- Protection des mots de passe (hashage)
- Sanitization des données

## 🤝 Contribution

1. Fork le projet
2. Créez votre branche : `git checkout -b feature/ma-fonctionnalite`
3. Committez vos changements : `git commit -m 'Ajout: Nouvelle fonctionnalité'`
4. Push vers la branche : `git push origin feature/ma-fonctionnalite`
5. Ouvrez une Pull Request

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 👥 Auteurs

- [Votre Nom] - Développeur Principal
- [Autres Contributeurs]

## 🙏 Remerciements

- Équipe de développement
- Contributeurs open source
- Communauté PHP

---

✨ **Tripster** - Faites voyager vos rêves ! ✨
