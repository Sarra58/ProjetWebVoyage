<?php
class Activity {
    private $id;
    private $event_id;
    private $titre;
    private $description;
    private $date;
    private $heure;
    private $lieu;
    private $photo;

    public function __construct($id, $titre, $description, $date, $heure, $lieu, $photo, $event_id) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->date = $date;
        $this->heure = $heure;
        $this->lieu = $lieu;
        $this->photo = $photo;
        $this->event_id = $event_id;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getEventId() {
        return $this->event_id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDate() {
        return $this->date;
    }

    public function getHeure() {
        return $this->heure;
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

    public function setEventId($event_id) {
        $this->event_id = $event_id;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setHeure($heure) {
        $this->heure = $heure;
    }

    public function setLieu($lieu) {
        $this->lieu = $lieu;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }
}
?>
