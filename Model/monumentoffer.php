<?php

class MonumentOffer {
    private ?int $id_monument;
    private ?int $transport_id;
    private ?string $nom_monument;
    private ?string $date_depart;
    private ?string $heure_depart;

    public function __construct(
        ?int $id_monument,
        ?int $transport_id,
        ?string $nom_monument,
        ?string $date_depart,
        ?string $heure_depart
    ) {
        $this->id_monument = $id_monument;
        $this->transport_id = $transport_id;
        $this->nom_monument = $nom_monument;
        $this->date_depart = $date_depart;
        $this->heure_depart = $heure_depart;
    }

    public function getIdMonument(): ?int {
        return $this->id_monument;
    }

    public function setIdMonument(?int $id_monument): void {
        $this->id_monument = $id_monument;
    }

    public function getTransportId(): ?int {
        return $this->transport_id;
    }

    public function setTransportId(?int $transport_id): void {
        $this->transport_id = $transport_id;
    }

    public function getNomMonument(): ?string {
        return $this->nom_monument;
    }

    public function setNomMonument(?string $nom_monument): void {
        $this->nom_monument = $nom_monument;
    }

    public function getDateDepart(): ?string {
        return $this->date_depart;
    }

    public function setDateDepart(?string $date_depart): void {
        $this->date_depart = $date_depart;
    }

    public function getHeureDepart(): ?string {
        return $this->heure_depart;
    }

    public function setHeureDepart(?string $heure_depart): void {
        $this->heure_depart = $heure_depart;
    }
}

?>
