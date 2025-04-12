<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/TransportOffer.php');

class TransportController
{
    public function listTransport()
    {
        $sql = "SELECT * FROM transport";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function deleteTransport($id)
    {
        $sql = "DELETE FROM transport WHERE id_de_transport = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
    
        try {
            $req->execute();
            
            if ($req->rowCount() > 0) {
                echo "✅ Transport supprimé avec succès.";
            } else {
                echo "❌ Aucun transport trouvé avec cet ID.";
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    

    public function addTransport($transport)
    {
        // Afficher les données du formulaire pour déboguer
        var_dump([
            'nom_bapteme' => $transport->getNomBapteme(),
            'nbre_de_place' => $transport->getNbreDePlace(),
            'couleur' => $transport->getCouleur(),
            'marque' => $transport->getMarque(),
            'kilometrage' => $transport->getKilometrage()
        ]);
    
        $sql = "INSERT INTO transport (nom_bapteme, nbre_de_place, couleur, marque, kilometrage) 
                VALUES (:nom_bapteme, :nbre_de_place, :couleur, :marque, :kilometrage)";
        
        $db = config::getConnexion();  // Assurez-vous que la connexion est correcte
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom_bapteme' => $transport->getNomBapteme(),
                'nbre_de_place' => $transport->getNbreDePlace(),
                'couleur' => $transport->getCouleur(),
                'marque' => $transport->getMarque(),
                'kilometrage' => $transport->getKilometrage()
            ]);
    
            // Vérification si l'insertion a été effectuée
            if ($query->rowCount() > 0) {
                // Utiliser LAST_INSERT_ID pour obtenir l'ID généré
                $lastInsertedId = $db->lastInsertId();
                echo "Transport ajouté avec succès! ID généré: " . $lastInsertedId;
            } else {
                echo "Aucune ligne ajoutée. Il semble qu'il y ait un problème avec l'insertion.";
            }
        } catch (PDOException $e) {
            // Loggez l'erreur dans un fichier et affichez le message d'erreur
            echo 'Erreur de base de données : ' . $e->getMessage();
            // Optionnellement, loggez l'erreur pour un suivi ultérieur
            error_log($e->getMessage(), 3, 'errors.log');
        }
    }
    

    public function updateTransport($transport)
    {
        try {
            echo "<h3>🚀 updateTransport appelée</h3>";
    
            $db = config::getConnexion();
            $id = $transport->getIdDeTransport();
    
            $params = [
                'id' => $id,
                'nom_bapteme' => $transport->getNomBapteme(),
                'nbre_de_place' => $transport->getNbreDePlace(),
                'couleur' => $transport->getCouleur(),
                'marque' => $transport->getMarque(),
                'kilometrage' => $transport->getKilometrage()
            ];
    
            echo "<h4>🛠️ Paramètres d'update :</h4><pre>";
            print_r($params);
            echo "</pre>";
    
            $query = $db->prepare(
                'UPDATE transport SET 
                    nom_bapteme = :nom_bapteme,
                    nbre_de_place = :nbre_de_place,
                    couleur = :couleur,
                    marque = :marque,
                    kilometrage = :kilometrage
                WHERE id_de_transport = :id'
            );
    
            $query->execute($params);
    
            $rowCount = $query->rowCount();
            echo "<h4>🔁 Lignes modifiées : $rowCount</h4>";
    
            return $rowCount > 0;
        } catch (PDOException $e) {
            echo "<div class='error'>❌ Erreur PDO : " . $e->getMessage() . "</div>";
            return false;
        }
    }
    
    

    function showTransport($id)
    {
        $sql = "SELECT * from transport where id_de_transport = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $transport = $query->fetch();
            return $transport;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function showAllTransports()
    {
        $sql = "SELECT * FROM transport";
        $db = config::getConnexion();

        try {
            $query = $db->query($sql);
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function getTransportById($id)
    {
        try {
            echo "<pre>📦 ID reçu dans getTransportById: ";
            var_dump($id);
            echo "</pre>";
    
            $db = config::getConnexion();
            $query = $db->prepare("SELECT * FROM transport WHERE id_de_transport = :id");
            $query->execute(['id' => $id]);
            $data = $query->fetch();
    
            if ($data) {
                echo "<div>✅ Transport trouvé</div>";
                return new Transport(
                    $data['id_de_transport'],
                    $data['nom_bapteme'],
                    $data['nbre_de_place'],
                    $data['couleur'],
                    $data['marque'],
                    $data['kilometrage']
                );
            } else {
                echo "<div>❌ Aucun transport trouvé avec cet ID</div>";
                return null;
            }
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
            return null;
        }
    }
    
}
?>
