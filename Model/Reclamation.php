<?php

class Reclamation
{
    private ?int $id = null;
    private ?int $utilisateur_id = null;
    private ?string $sujet = null;
    private ?string $description = null;
    private ?string $statut = null;
    private ?string $date_creation = null;
    private ?string $date_fermeture = null;

    public function __construct($utilisateur_id, $sujet, $description, $statut = 'ouvert', $date_creation = null, $date_fermeture = null)
    {
        $this->utilisateur_id = $utilisateur_id;
        $this->sujet = $sujet;
        $this->description = $description;
        $this->statut = $statut;
        $this->date_creation = $date_creation;
        $this->date_fermeture = $date_fermeture;
    }

    // Getters and setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        return $this->id=$id;
    }

    public function getUtilisateurId()
    {
        return $this->utilisateur_id;
    }
    public function getSujet()
    {
        return $this->sujet;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getStatut()
    {
        return $this->statut;
    }
    public function getDateCreation()
    {
        return $this->date_creation;
    }
    public function getDateFermeture()
    {
        return $this->date_fermeture;
    }

    public function setUtilisateurId($utilisateur_id)
    {
        $this->utilisateur_id = $utilisateur_id;
    }
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }
    public function setDateFermeture($date_fermeture)
    {
        $this->date_fermeture = $date_fermeture;
    }
}