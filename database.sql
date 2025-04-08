CREATE TABLE Reclamation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    sujet VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    statut ENUM('ouvert', 'en cours', 'fermer') DEFAULT 'ouvert',
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_fermeture DATETIME
);

CREATE TABLE Reponse (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reclamation_id INT NOT NULL,
    contenu TEXT NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (reclamation_id) REFERENCES Reclamation(id)
);
