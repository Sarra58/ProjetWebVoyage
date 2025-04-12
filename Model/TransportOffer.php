<?php

class Transport {
    private ?int $id_de_transport;
    private ?string $nom_bapteme;
    private ?int $nbre_de_place;
    private ?string $couleur;
    private ?string $marque;
    private ?int $kilometrage;

    public function __construct(
        ?int $id_de_transport,
        ?string $nom_bapteme, 
        ?int $nbre_de_place, 
        ?string $couleur, 
        ?string $marque, 
        ?int $kilometrage
    ) {
        $this->id_de_transport = $id_de_transport;
        $this->nom_bapteme = $nom_bapteme;
        $this->nbre_de_place = $nbre_de_place;
        $this->couleur = $couleur;
        $this->marque = $marque;
        $this->kilometrage = $kilometrage;
    }

    public function getIdDeTransport(): ?int {
        return $this->id_de_transport;
    }

    public function setIdDeTransport(?int $id_de_transport): void {
        $this->id_de_transport = $id_de_transport;
    }

    public function getNomBapteme(): ?string {
        return $this->nom_bapteme;
    }

    public function setNomBapteme(?string $nom_bapteme): void {
        $this->nom_bapteme = $nom_bapteme;
    }

    public function getNbreDePlace(): ?int {
        return $this->nbre_de_place;
    }

    public function setNbreDePlace(?int $nbre_de_place): void {
        $this->nbre_de_place = $nbre_de_place;
    }

    public function getCouleur(): ?string {
        return $this->couleur;
    }

    public function setCouleur(?string $couleur): void {
        $this->couleur = $couleur;
    }

    public function getMarque(): ?string {
        return $this->marque;
    }

    public function setMarque(?string $marque): void {
        $this->marque = $marque;
    }

    public function getKilometrage(): ?int {
        return $this->kilometrage;
    }

    public function setKilometrage(?int $kilometrage): void {
        $this->kilometrage = $kilometrage;
    }
}


?>
