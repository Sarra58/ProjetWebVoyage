<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/monumentoffer.php');

class MonumentController
{
    public function listMonuments()
    {
        $sql = "SELECT * FROM monument";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function addMonument($monument)
    {
        $sql = "INSERT INTO transport_monument (transport_id, nom_monument, date_depart, heure_depart) 
                VALUES (:transport_id, :nom_monument, :date_depart, :heure_depart)";
        
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'transport_id' => $monument->getTransportId(),
                'nom_monument' => $monument->getNomMonument(),
                'date_depart' => $monument->getDateDepart(),
                'heure_depart' => $monument->getHeureDepart()
            ]);
            return $db->lastInsertId();
        } catch (PDOException $e) {
            echo 'Erreur de base de données : ' . $e->getMessage();
            return false;
        }
    }

    public function deleteMonument($id)
    {
        $sql = "DELETE FROM transport_monument WHERE id_monument = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        try {
            $req->execute();
            echo $req->rowCount() > 0 
                ? "✅ Monument supprimé avec succès." 
                : "❌ Aucun monument trouvé avec cet ID.";
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function updateMonument($monument)
    {
        $sql = "UPDATE transport_monument SET 
                    transport_id = :transport_id,
                    nom_monument = :nom_monument,
                    date_depart = :date_depart,
                    heure_depart = :heure_depart
                WHERE id_monument = :id";
        
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $monument->getIdMonument(),
                'transport_id' => $monument->getTransportId(),
                'nom_monument' => $monument->getNomMonument(),
                'date_depart' => $monument->getDateDepart(),
                'heure_depart' => $monument->getHeureDepart()
            ]);
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            echo 'Erreur PDO : ' . $e->getMessage();
            return false;
        }
    }

    public function getMonumentById($id)
    {
        $sql = "SELECT * FROM transport_monument WHERE id_monument = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            $data = $query->fetch();

            if ($data) {
                return new MonumentOffer(
                    $data['id_monument'],
                    $data['transport_id'],
                    $data['nom_monument'],
                    $data['date_depart'],
                    $data['heure_depart']
                );
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }

    public function showAllMonuments()
    {
        $sql = "SELECT * FROM transport_monument";
        $db = config::getConnexion();

        try {
            $query = $db->query($sql);
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>
