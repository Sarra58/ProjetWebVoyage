<?php


    include __DIR__ . 'config.php';
    include __DIR__ . 'Model\Evenement.php';

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
    class EvenementC {
        public function addEvenement($evenement) {
            $db = Config::getConnexion();

            try {
                $sql = "INSERT INTO Evenement (id, name, participant, description, datetime) VALUES (:id, :name, :participant, :description, :datetime)";

                $query = $db->prepare($sql);
                $query->execute([
                    'id' => $evenement->getEventId(),
                    'name' => $evenement->getEventName(),
                    'participant' => $evenement->getParticipant(),
                    'description' => $evenement->getDescription(),
                    'datetime' => $evenement->getEventDateTime()
                ]);
                //header("Location: http://localhost/projetWebMinyar/View/front-office/ajout_succees.html");
            } catch (Exception $e) {
                die('❌ Erreur : ' . $e->getMessage());
            }
        }
    }

    // === TRAITEMENT DU FORMULAIRE ===
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $evenement = new Evenement(
            $_POST["id"],
            $_POST["name"],
            $_POST["participant"],
            $_POST["description"],
            $_POST["datetime"]
        );

        $controller = new EvenementC();
        $controller->addEvenement($evenement);
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