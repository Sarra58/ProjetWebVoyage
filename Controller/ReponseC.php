<?php
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

    $utilisateur_id = $_POST['utilisateur_id'];

    $db = config::getConnexion();

    // Étape 1 : Récupérer les IDs des réclamations
    $sql = "SELECT id FROM reclamation WHERE utilisateur_id = :utilisateur_id";
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
        $stmt->execute();
        $reclamation_ids = $stmt->fetchAll(PDO::FETCH_COLUMN); // récupère un tableau des IDs

    } catch (Exception $e) {
        die('Erreur lors de la récupération des réclamations : ' . $e->getMessage());
    }

    // Étape 2 : Préparer la table HTML avec Bootstrap pour un meilleur design
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">';
    echo "<div class='container my-4'>"; // Container for responsive layout
    echo "<h2 class='text-center mb-4'>Réponses aux Réclamations</h2>";
    echo "<table class='table table-bordered table-striped table-hover table-sm'>";
    echo "<thead class='table-dark'><tr><th>Contenu</th><th>Date de création</th></tr></thead>";
    echo "<tbody>";

    // Étape 3 : Pour chaque réclamation, récupérer les réponses
    $sql_reponse = "SELECT contenu, date_creation FROM reponse WHERE reclamation_id = :reclamation_id";
    try {
        $stmt_reponse = $db->prepare($sql_reponse);

        foreach ($reclamation_ids as $reclamation_id) {
            $stmt_reponse->bindParam(':reclamation_id', $reclamation_id, PDO::PARAM_INT);
            $stmt_reponse->execute();
            $reponses = $stmt_reponse->fetchAll(PDO::FETCH_ASSOC);

            foreach ($reponses as $reponse) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($reponse['contenu']) . "</td>";
                echo "<td>" . htmlspecialchars($reponse['date_creation']) . "</td>";
                echo "</tr>";
            }
        }

    } catch (Exception $e) {
        die('Erreur lors de la récupération des réponses : ' . $e->getMessage());
    }

    echo "</tbody></table>";
    echo "</div>";
?>
