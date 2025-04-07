<?php
include_once("../../View/BackOffice/config.php");
include_once("../../Model/TravelOffer.php");

class TravelOfferC {
    function listOffre() {
        $sql = "SELECT * FROM TravelOffer";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
    function deleteOffer($id) {
        $sql = "DELETE FROM TravelOffer WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
    function addOffre($offer) {
        $sql = "INSERT INTO TravelOffer (titre, destination, date_depart, date_retour, prix, disponible, categorie) 
                VALUES (:titre, :destination, :date_depart, :date_retour, :prix, :disponible, :categorie)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $offer->getTitre(),
                'destination' => $offer->getDestination(),
                'date_depart' => $offer->getDateDepart(),
                'date_retour' => $offer->getDateRetour(),
                'prix' => $offer->getPrix(),
                'disponible' => $offer->getDisponible(),
                'categorie' => $offer->getCategorie()
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
    function getOfferById($id) {
        $sql = "SELECT * FROM TravelOffer WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $offer = $query->fetch();
            return $offer;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
    function updateOffer($offer, $id) {
        $sql = "UPDATE TravelOffer SET 
                titre = :titre,
                destination = :destination,
                date_depart = :date_depart,
                date_retour = :date_retour,
                prix = :prix,
                disponible = :disponible,
                categorie = :categorie
                WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $offer->getTitre(),
                'destination' => $offer->getDestination(),
                'date_depart' => $offer->getDateDepart(),
                'date_retour' => $offer->getDateRetour(),
                'prix' => $offer->getPrix(),
                'disponible' => $offer->getDisponible(),
                'categorie' => $offer->getCategorie(),
                'id' => $id
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>