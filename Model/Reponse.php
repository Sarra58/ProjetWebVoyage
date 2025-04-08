<?php

class Reponse
{
    private ?int $id = null;
    private ?int $reclamation_id = null;
    private ?string $contenu = null;
    private ?string $date_creation = null;

    public function __construct($reclamation_id, $contenu, $date_creation = null)
    {
        $this->reclamation_id = $reclamation_id;
        $this->contenu = $contenu;
        $this->date_creation = $date_creation;
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
    public function getReclamationId()
    {
        return $this->reclamation_id;
    }
    public function getContenu()
    {
        return $this->contenu;
    }
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    public function setReclamationId($reclamation_id)
    {
        $this->reclamation_id = $reclamation_id;
    }
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }
}