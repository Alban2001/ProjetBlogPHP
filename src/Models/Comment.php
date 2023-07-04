<?php

namespace Models;

use DateTime;
use Models\User;

class Comment
{
    // Attributs de l'entité Comment
    private int $code;
    private int $idArticle;
    private string $contenu;
    private DateTime $dateCreation; //La date de création est la date du jour par défaut lors de la création du commentaire
    private int $valide = 0;
    private int $idUtilisateur;
    private string $nomUtilisateur;
    private string $prenomUtilisateur;

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
    // Attribution de l'ID article
    public function setIdArticle(int $idArticle): self
    {
        $this->idArticle = $idArticle;

        return $this;
    }
    // Affichage de l'article 
    public function getIdArticle(): int
    {
        return $this->idArticle;
    }

    // Attribution du contenu
    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }
    // Affichage du contenu
    public function getContenu(): string
    {
        return $this->contenu;
    }

    // Attribution de la date de création
    public function setDateCreation(DateTime $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }
    // Affichage de la date de création
    public function getDateCreation(): DateTime
    {
        return $this->dateCreation;
    }

    // Attribution de valide
    public function setValide(int $valide): self
    {
        $this->valide = $valide;

        return $this;
    }
    // Affichage de valide
    public function getValide(): int
    {
        return $this->valide;
    }

    // Attribution de l'ID utilisateur
    public function setIdUtilisateur(int $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    // Affichage de l'ID utilisateur
    public function getIdUtilisateur(): int
    {
        return $this->idUtilisateur;
    }
    // Attribution du nom de l'utilisateur
    public function setNomUtilisateur(string $nomUtilisateur): self
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }
    // Affichage du nom de l'utilisateur
    public function getNomUtilisateur(): string
    {
        return $this->nomUtilisateur;
    }

    // Attribution du nom de l'utilisateur
    public function setPrenomUtilisateur(string $prenomUtilisateur): self
    {
        $this->prenomUtilisateur = $prenomUtilisateur;

        return $this;
    }
    // Affichage du nom de l'utilisateur
    public function getPreomUtilisateur(): string
    {
        return $this->prenomUtilisateur;
    }
}