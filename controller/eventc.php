<?php
require_once '../../config.php';
require_once '../../Model/Event.php';

class eventc 
{
    public function addEvent($Event) {
        try {
            $db = config::getConnexion();
            $sql = "INSERT INTO event (titre, description, date_debut, date_fin, lieu, photo) 
                    VALUES (:titre, :description, :date_debut, :date_fin, :lieu, :photo)";
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $Event->getTitre(),
                'description' => $Event->getDescription(),
                'date_debut' => $Event->getDateDebut(),
                'date_fin' => $Event->getDateFin(),
                'lieu' => $Event->getLieu(),
                'photo' => $Event->getPhoto()
            ]);
            return true;
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return false;
        }
    }

    public function getAllEvents() {
        try {
            $db = config::getConnexion();
            $sql = "SELECT * FROM event";
            $query = $db->query($sql);
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return [];
        }
    }

    public function getEventById($id) {
        try {
            $db = config::getConnexion();
            $sql = "SELECT * FROM event WHERE id = :id";
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return $query->fetch();
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return null;
        }
    }

    public function updateEvent($Event) {
        try {
            $db = config::getConnexion();
            $sql = "UPDATE event SET titre = :titre, description = :description, date_debut = :date_debut, 
                    date_fin = :date_fin, lieu = :lieu, photo = :photo WHERE id = :id";
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $Event->getTitre(),
                'description' => $Event->getDescription(),
                'date_debut' => $Event->getDateDebut(),
                'date_fin' => $Event->getDateFin(),
                'lieu' => $Event->getLieu(),
                'photo' => $Event->getPhoto(),
                'id' => $Event->getId()
            ]);
            return true;
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return false;
        }
    }

    public function deleteEvent($id) {
        try {
            $db = config::getConnexion();
            $sql = "DELETE FROM event WHERE id = :id";
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return false;
        }
    }

    function chercher_titre($titre) 
    {
        $db = config::getConnexion();
        $search_query = "SELECT * FROM event WHERE titre = :titre";
        $stmt = $db->prepare($search_query);
        $stmt->execute(array(':titre' => $titre));
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } else {
            return NULL;
        }
    }
}
?>
