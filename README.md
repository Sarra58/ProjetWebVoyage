# 🚚 Entité Transport – Application Web (Modèle MVC)

Ce dépôt contient l’implémentation de l’entité **Transport** dans une application web structurée selon le modèle **MVC (Modèle – Vue – Contrôleur)**.

---

## 📦 Structure du projet

/transport │ ├── Controllers │ └── TransportController.php │ ├── Models │ └── Transport.php │ ├── Views │ ├── index.html │ ├── create.html │ └── edit.html │ └── README.md

yaml
Copy
Edit

---

## 🛣️ Description de l'entité `Transport`

L'entité **Transport** correspond à un véhicule dans le système. Elle est liée à la table `transport` dans la base de données, avec les colonnes suivantes :

| Champ               | Type         | Description                         |
|---------------------|--------------|-------------------------------------|
| `id_de_transport`   | INT (PK)     | Identifiant unique du transport     |
| `nom_de_bapteme`    | VARCHAR      | Nom attribué au véhicule            |
| `kilometrage`       | INT          | Kilométrage actuel du véhicule      |
| `marque`            | VARCHAR      | Marque du véhicule (ex. Toyota)     |
| `nombre_de_place`   | INT          | Nombre de places disponibles        |

---

## 🔧 Fonctionnalités principales

- ✅ Lister tous les transports
- ➕ Ajouter un nouveau transport
- ✏️ Modifier un transport existant
- ❌ Supprimer un transport
- 🔍 Rechercher ou filtrer selon la marque, le nom de baptême ou le kilométrage

---

## 🛠️ Technologies utilisées

- **Front-end** : HTML / CSS / JavaScript
- **Back-end** : PHP (ou autre langage selon le framework)
- **Base de données** : MySQL ou autre SGBD relationnel
- **Architecture** : MVC (Modèle – Vue – Contrôleur)

---

## 📘 Exemple de modèle `Transport.php`

```php
class Transport {
    public $id_de_transport;
    public $nom_de_bapteme;
    public $kilometrage;
    public $marque;
    public $nombre_de_place;

    // Méthodes de récupération, insertion, mise à jour, suppression, etc.
}
