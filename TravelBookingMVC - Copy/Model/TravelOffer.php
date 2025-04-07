<?php
class TravelOffer {
    private $id;
    private $titre;
    private $destination;
    private $date_depart;
    private $date_retour;
    private $prix;
    private $disponible;
    private $categorie;

    public function __construct($id = null, $titre = null, $destination = null, $date_depart = null, $date_retour = null, $prix = null, $disponible = null, $categorie = null) {
        $this->id = $id;
        $this->titre = $titre;
        $this->destination = $destination;
        $this->date_depart = $date_depart;
        $this->date_retour = $date_retour;
        $this->prix = $prix;
        $this->disponible = $disponible;
        $this->categorie = $categorie;
    }

    // Getters
    public function getId() {
        return $this->id;
    }
    
    public function getTitre() {
        return $this->titre;
    }
    
    public function getDestination() {
        return $this->destination;
    }
    
    public function getDateDepart() {
        return $this->date_depart;
    }
    
    public function getDateRetour() {
        return $this->date_retour;
    }
    
    public function getPrix() {
        return $this->prix;
    }
    
    public function getDisponible() {
        return $this->disponible;
    }
    
    public function getCategorie() {
        return $this->categorie;
    }
    
    // Setters
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setTitre($titre) {
        $this->titre = $titre;
    }
    
    public function setDestination($destination) {
        $this->destination = $destination;
    }
    
    public function setDateDepart($date_depart) {
        $this->date_depart = $date_depart;
    }
    
    public function setDateRetour($date_retour) {
        $this->date_retour = $date_retour;
    }
    
    public function setPrix($prix) {
        $this->prix = $prix;
    }
    
    public function setDisponible($disponible) {
        $this->disponible = $disponible;
    }
    
    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    public function show() {
        echo "<table border='1'>";
        echo "<tr><td><strong>Titre</strong>: " . htmlspecialchars($this->titre) . "</td> ";
        echo "<td><strong>Destination</strong>: " . htmlspecialchars($this->destination) . "</td>";
        echo "<td><strong>Date de départ</strong>: " . htmlspecialchars($this->date_depart) . "</td>";
        echo "<td><strong>Date de retour</strong>: " . htmlspecialchars($this->date_retour) . "</td>";
        echo "<td><strong>Prix</strong>: " . htmlspecialchars($this->prix) . " TND</td>";
        echo "<td><strong>Disponible</strong>: " . ($this->disponible ? "Oui" : "Non") . "</td>";
        echo "<td><strong>Catégorie</strong>: " . htmlspecialchars($this->categorie) . "</td>";
        echo "</table>";
    }
}
?>