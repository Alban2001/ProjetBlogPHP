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
    /**
     * Valeur par défaut : un utlisateur a le rôle "User" automatiquement lorsqu'il crééra un compte
     * @var string role
     */

    private string $role = "user";

    /**
     * Method setId
     *
     * @param int $code [Attribution de l'ID]
     *
     * @return self
     */
    public function setId(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Affichage de l'ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->code;
    }

    /**
     * Method setNom
     *
     * @param string $nom [Attribution du nom]
     *
     * @return self
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Affichage du nom
     *
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Method setPrenom
     *
     * @param string $prenom [Attribution du prénom]
     *
     * @return self
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Affichage du prénom
     *
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Method setAdresseMail
     *
     * @param string $adresseMail [Attribution de l'adresse mail]
     *
     * @return self
     */
    public function setAdresseMail(string $adresseMail): self
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }

    /**
     * Affichage de l'adresse mail
     *
     * @return string
     */
    public function getAdresseMail(): string
    {
        return $this->adresseMail;
    }

    /**
     * Method setMotDePasse
     *
     * @param string $motDePasse [Attribution du mot de passe]
     *
     * @return self
     */
    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    /**
     * Affichage du mot de passe
     *
     * @return string
     */
    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

    /**
     * Method setValide
     *
     * @param int $valide [Attribution de valide]
     *
     * @return self
     */
    public function setValide(int $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Affichage de l'ID
     *
     * @return int
     */
    public function getValide(): int
    {
        return $this->valide;
    }

    /**
     * Method setRole
     *
     * @param string $role [Attribution du rôle]
     *
     * @return self
     */
    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Affichage du rôle
     *
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }
}