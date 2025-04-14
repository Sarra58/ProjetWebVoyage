<?php
require_once '../../config.php';
require_once '../../Model/Activity.php';

class activityc
{
    public function addActivity($Activity) {
        try {
            $db = config::getConnexion();
            $sql = "INSERT INTO activity (titre, description, date, heure, lieu, photo, event_id)
                    VALUES (:titre, :description, :date, :heure, :lieu, :photo, :event_id)";
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $Activity->getTitre(),
                'description' => $Activity->getDescription(),
                'date' => $Activity->getDate(),
                'heure' => $Activity->getHeure(),
                'lieu' => $Activity->getLieu(),
                'photo' => $Activity->getPhoto(),
                'event_id' => $Activity->getEventId()
            ]);
            return true;
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return false;
        }
    }

    public function getAllActivities() {
        try {
            $db = config::getConnexion();
            $sql = "SELECT * FROM activity";
            $query = $db->query($sql);
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return [];
        }
    }

    public function getActivityById($id) {
        try {
            $db = config::getConnexion();
            $sql = "SELECT * FROM activity WHERE id = :id";
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return $query->fetch();
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return null;
        }
    }

    public function updateActivity($Activity) {
        try {
            $db = config::getConnexion();
            $sql = "UPDATE activity SET titre = :titre, description = :description,
                    date = :date, heure = :heure, lieu = :lieu, photo = :photo, event_id = :event_id
                    WHERE id = :id";
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $Activity->getTitre(),
                'description' => $Activity->getDescription(),
                'date' => $Activity->getDate(),
                'heure' => $Activity->getHeure(),
                'lieu' => $Activity->getLieu(),
                'photo' => $Activity->getPhoto(),
                'event_id' => $Activity->getEventId(),
                'id' => $Activity->getId()
            ]);
            return true;
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return false;
        }
    }

    public function deleteActivity($id) {
        try {
            $db = config::getConnexion();
            $sql = "DELETE FROM activity WHERE id = :id";
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return false;
        }
    }
}
?>
