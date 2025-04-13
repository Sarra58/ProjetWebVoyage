<?php

class User {
    private ?int $id;
    private ?string $nom;
    private ?string $prenom;
    private ?string $email;
    private ?string $password;
    private ?string $role;
    private ?int $Tel;
    

    public function __construct(?int $id, ?string $nom,?string $prenom,?string $email, ?string $password, ?string $role,?int $Tel) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->Tel= $Tel;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getName(): ?string {
        return $this->nom;
    }

    public function setName(?string $nom): void {
        $this->nom = $nom;
    }
    public function getPrenom(): ?string {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): void {
        $this->prenom = $prenom;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(?string $password): void {
        $this->password = $password;
    }

    public function getRole(): ?string {
        return $this->role;
    }

    public function setRole(?string $role): void {
        $this->role = $role;
    }
    public function getTel(): ?int {
        return $this->Tel;
    }

    public function setTel(?int $Tel): void {
        $this->Tel = $Tel;
    }
}
?>
