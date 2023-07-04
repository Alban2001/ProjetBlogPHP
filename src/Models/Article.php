<?php

namespace Models;

use DateTime;

class Article
{
    // Attributs de l'entité Article
    private int $code;
    private string $titre;
    private string $image;
    private string $chapo;
    private string $contenu;
    private DateTime $dateCreation; //La date de création est la date du jour par défaut lors de la création de l'article
    private DateTime $dateDerniereMaj; //La date de création est la date du jour par défaut lors de la création de l'article
    private int $idUtilisateur;

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

    // Attribution du titre
    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    // Affichage du titre
    public function getTitre(): string
    {
        return $this->titre;
    }

    // Attribution de l'image
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    // Affichage de l'image
    public function getImage(): string
    {
        return $this->image;
    }

    // Attribution du chapô
    public function setChapo(string $chapo): self
    {
        $this->chapo = $chapo;

        return $this;
    }
    // Affichage du chapô
    public function getChapo(): string
    {
        return $this->chapo;
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

    // Attribution de la date de dernière MAJ
    public function setDateDerniereMaj(DateTime $dateDerniereMaj): self
    {
        $this->dateDerniereMaj = $dateDerniereMaj;

        return $this;
    }
    // Affichage de la date de dernière MAJ
    public function getDateDerniereMaj(): DateTime
    {
        return $this->dateDerniereMaj;
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

}