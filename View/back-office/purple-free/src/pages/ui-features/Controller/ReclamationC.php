<?php


    include __DIR__ . 'config.php';
    include __DIR__ . 'Model\Reclamation.php';

    // === CONFIGURATION DE LA BASE DE DONNÉES ===
    class Config {
        private static $pdo = null;

        public static function getConnexion() {
            if (!isset(self::$pdo)) {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "my_database";

                try {
                    self::$pdo = new PDO(
                        "mysql:host=$servername;dbname=$dbname;charset=utf8",
                        $username,
                        $password,
                        [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                        ]
                    );
                } catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
            }
            return self::$pdo;
        }
    }

    // === MODÈLE RECLAMATION ===
    class Reclamation {
        private $utilisateur_id;
        private $sujet;
        private $description;
        private $statut;
        private $date_creation;
        private $date_fermeture;

        public function __construct($utilisateur_id, $sujet, $description, $statut, $date_creation, $date_fermeture) {
            $this->utilisateur_id = $utilisateur_id;
            $this->sujet = $sujet;
            $this->description = $description;
            $this->statut = $statut;
            $this->date_creation = $date_creation;
            $this->date_fermeture = $date_fermeture;
        }

        public function getUtilisateurId() { return $this->utilisateur_id; }
        public function getSujet() { return $this->sujet; }
        public function getDescription() { return $this->description; }
        public function getStatut() { return $this->statut; }
        public function getDateCreation() { return $this->date_creation; }
        public function getDateFermeture() { return $this->date_fermeture; }
    }

    // === CONTRÔLEUR RECLAMATION ===
    class ReclamationC {
        public function addReclamation($reclamation) {
            $db = Config::getConnexion();

            try {
                $sql = "INSERT INTO Reclamation (utilisateur_id, sujet, description, statut, date_creation, date_fermeture) 
                        VALUES (:utilisateur_id, :sujet, :description, :statut, :date_creation, :date_fermeture)";

                $query = $db->prepare($sql);
                $query->execute([
                    'utilisateur_id' => $reclamation->getUtilisateurId(),
                    'sujet' => $reclamation->getSujet(),
                    'description' => $reclamation->getDescription(),
                    'statut' => $reclamation->getStatut(),
                    'date_creation' => $reclamation->getDateCreation(),
                    'date_fermeture' => $reclamation->getDateFermeture()
                ]);

                header("Location: http://localhost/projetWebMinyar/View/back-office/purple-free/src/pages/ui-features/affichage.php");
            } catch (Exception $e) {
                die('❌ Erreur : ' . $e->getMessage());
            }
        }
    }

    // === TRAITEMENT DU FORMULAIRE ===
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $reclamation = new Reclamation(
            $_POST["utilisateur_id"],
            $_POST["sujet"],
            $_POST["description"],
            $_POST["statut"],
            $_POST["date_creation"],
            $_POST["date_fermeture"]
        );

        $controller = new ReclamationC();
        $controller->addReclamation($reclamation);
    }





//     public function listReclamations()
//     {
//         $sql = "SELECT * FROM reclamation";
//         $db = config::getConnexion();
//         try {
//             return $db->query($sql);
//         } catch (Exception $e) {
//             die('Error: ' . $e->getMessage());
//         }
//     }

//     public function deleteReclamation($id)
//     {
//         $sql = "DELETE FROM reclamation WHERE id = :id";
//         $db = config::getConnexion();
//         try {
//             $query = $db->prepare($sql);
//             $query->bindValue(':id', $id);
//             $query->execute();
//         } catch (Exception $e) {
//             die('Error: ' . $e->getMessage());
//         }
//     }

//     public function updateReclamationn($reclamation, $id)
//     {
//         $sql = "UPDATE reclamation SET 
//                     sujet = :sujet, 
//                     description = :description, 
//                     statut = :statut, 
//                     date_fermeture = CURRENT_TIMESTAMP
//                 WHERE id = :id";
//         $db = config::getConnexion();
//         try {
//             $query = $db->prepare($sql);
//             $query->execute([
//                 'sujet' => $reclamation->getSujet(),
//                 'description' => $reclamation->getDescription(),
//                 'statut' => $reclamation->getStatut(),
//                 'id' => $id
//             ]);
//         } catch (Exception $e) {
//             die('Error: ' . $e->getMessage());
//         }
//     }
    
    
//     public function listReclamationsbyid()
//     {
//         $sql = "SELECT id FROM reclamation"; // Requête pour récupérer les ID des réclamations
//         $db = config::getConnexion();
        
//         try {
//             $stmt = $db->prepare($sql);
//             $stmt->execute();
//             return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne les résultats sous forme de tableau associatif
//         } catch (Exception $e) {
//             die('Error: ' . $e->getMessage());
//         }
//     }
//     public function updateReclamation($reclamation)
// {
//     try {
//         $db = config::getConnexion();
//         $query = $db->prepare(
//             'UPDATE reclamation SET 
//                 utilisateur_id = :utilisateur_id, 
//                 sujet = :sujet, 
//                 description = :description, 
//                 statut = :statut, 
//                 date_fermeture = :date_fermeture
//              WHERE id = :id'
//         );
//         $query->execute([
//             'id' => $reclamation->getId(),
//             'utilisateur_id' => $reclamation->getUtilisateurId(),
//             'sujet' => $reclamation->getSujet(),
//             'description' => $reclamation->getDescription(),
//             'statut' => $reclamation->getStatut(),
//             'date_fermeture' => $reclamation->getDateFermeture()
//         ]);
//         echo "Réclamation mise à jour avec succès.";
//     } catch (PDOException $e) {
//         echo "Erreur lors de la mise à jour : " . $e->getMessage();
//     }
//}



?>