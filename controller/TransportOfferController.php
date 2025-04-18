<?php
include_once(__DIR__ . '/../config.php'); 
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
        // Le reste du code d'insertion
        $sql = "INSERT INTO transport (nom_bapteme, nbre_de_place, couleur, marque, kilometrage) 
                VALUES (:nom_bapteme, :nbre_de_place, :couleur, :marque, :kilometrage)";
        
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom_bapteme' => $transport->getNomBapteme(),
                'nbre_de_place' => $transport->getNbreDePlace(),
                'couleur' => $transport->getCouleur(),
                'marque' => $transport->getMarque(),
                'kilometrage' => $transport->getKilometrage()
            ]);
            return $db->lastInsertId(); //
        } catch (PDOException $e) {
            echo 'Erreur de base de données : ' . $e->getMessage();
        }
    }
    

    public function updateTransport($transport)
    {
        try {
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
    
            return $rowCount > 0;
        } catch (PDOException $e) {
            // Tu peux aussi supprimer ce echo pour ne rien afficher du tout :
            // echo "<div class='error'>❌ Erreur PDO : " . $e->getMessage() . "</div>";
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
            // Debug supprimé
            $db = config::getConnexion();
            $query = $db->prepare("SELECT * FROM transport WHERE id_de_transport = :id");
            $query->execute(['id' => $id]);
            $data = $query->fetch();
    
            if ($data) {
                // Suppression du message "✅ Transport trouvé"
                return new Transport(
                    $data['id_de_transport'],
                    $data['nom_bapteme'],
                    $data['nbre_de_place'],
                    $data['couleur'],
                    $data['marque'],
                    $data['kilometrage']
                );
            } else {
                // Suppression du message "❌ Aucun transport trouvé avec cet ID"
                return null;
            }
        } catch (PDOException $e) {
            // Tu peux aussi supprimer ce echo si tu ne veux afficher aucune erreur
            // echo "Erreur: " . $e->getMessage();
            return null;
        }
    }
   public function showTransportWithMonuments($id = null)
{
    $db = config::getConnexion();
    try {
        // Requête pour obtenir les transports
        $sql = "SELECT * FROM transport";
        if ($id !== null) {
            $sql .= " WHERE id_transport = :id"; // Si un ID est passé, on filtre
        }

        $query = $db->prepare($sql);
        if ($id !== null) {
            $query->bindParam(':id', $id, PDO::PARAM_INT);
        }
        $query->execute();
        
        $transports = $query->fetchAll();

        // Récupérer les monuments associés à chaque transport
        foreach ($transports as &$transport) {
            $sqlMonuments = "SELECT * FROM transport_monument tm
                             JOIN monument m ON tm.id_monument = m.id_monument
                             WHERE tm.id_transport = :id_transport";

            $stmt = $db->prepare($sqlMonuments);
            $stmt->bindParam(':id_transport', $transport['id_transport'], PDO::PARAM_INT);
            $stmt->execute();

            $monuments = $stmt->fetchAll();
            $transport['monuments'] = $monuments; // Ajouter les monuments associés au transport
        }

        return $transports; // Retourner la liste des transports avec leurs monuments associés
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
} 
    
}

?>
