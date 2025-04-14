<?php
class Event {
    private $id;
    private $titre;
    private $description;
    private $date_debut;
    private $date_fin;
    private $lieu;
    private $photo;

    public function __construct($id, $titre, $description, $date_debut, $date_fin, $lieu, $photo) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->lieu = $lieu;
        $this->photo = $photo;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDateDebut() {
        return $this->date_debut;
    }

    public function getDateFin() {
        return $this->date_fin;
    }

    public function getLieu() {
        return $this->lieu;
    }

    public function getPhoto() {
        return $this->photo;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setDateDebut($date_debut) {
        $this->date_debut = $date_debut;
    }

    public function setDateFin($date_fin) {
        $this->date_fin = $date_fin;
    }

    public function setLieu($lieu) {
        $this->lieu = $lieu;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }
}
?>
