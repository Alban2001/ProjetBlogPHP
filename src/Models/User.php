<?php

namespace Models;

class User
{
    // Attributs de l'entité User
    private int $code;
    private string $nom;
    private string $prenom;
    private string $adresseMail;
    private string $motDePasse;
    private int $valide = 0;
    private string $role = "user"; // Valeur par défaut : un utlisateur a le rôle "User" automatiquement lorsqu'il crééra un compte  

    // Attribution de l'ID
    public function setId(int $code): self
    {
        $this->code = $code;

        return $this;
    }
    // Affichage de l'ID
    public function getId(): int
    {
        return $this->code;
    }

    // Attribution du nom
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    // Affichage du nom
    public function getNom(): string
    {
        return $this->nom;
    }

    // Attribution du prénom
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
    // Affichage du prénom
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    // Attribution de l'adresse mail
    public function setAdresseMail(string $adresseMail): self
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }
    // Affichage de l'adresse mail
    public function getAdresseMail(): string
    {
        return $this->adresseMail;
    }

    // Attribution du mot de passe
    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }
    // Affichage du mot de passe
    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

    // Attribution de valide
    public function setValide(int $valide): self
    {
        $this->valide = $valide;

        return $this;
    }
    // Affichage de l'ID
    public function getValide(): int
    {
        return $this->valide;
    }

    // Attribution du rôle
    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }
    // Affichage du rôle
    public function getRole(): string
    {
        return $this->role;
    }
}