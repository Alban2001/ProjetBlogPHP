<?php

namespace Models;

use DateTime;

class Article
{
    /*
     * Attributs de l'entité Article
     */

    /**
     * @var integer Code
     */
    private int $code;

    /**
     * @var string Titre
     */
    private string $titre;

    /**
     * @var string Image
     */
    private string $image;

    /**
     * @var string Chapo
     */
    private string $chapo;

    /**
     * @var string Contenu
     */
    private string $contenu;

    /**
     * La date de création est la date du jour par défaut lors de la création de l'article
     * @var DateTime DateCreation
     */
    private DateTime $dateCreation;

    /**
     * La date de création est la date du jour par défaut lors de la création de l'article
     * @var DateTime DateDerniereMaj
     */
    private DateTime $dateDerniereMaj;

    /**
     * @var integer IdUtilisateur
     */
    private int $idUtilisateur;

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
     * Method setTitre
     *
     * @param string $titre [Attribution du titre]
     *
     * @return self
     */
    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Affichage du titre
     *
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * Method setImage
     *
     * @param string $image [Attribution de l'image]
     *
     * @return self
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Affichage de l'image
     *
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * Method setChapo
     *
     * @param string $chapo [Attribution du chapô]
     *
     * @return self
     */
    public function setChapo(string $chapo): self
    {
        $this->chapo = $chapo;

        return $this;
    }

    /**
     * Affichage du chapô
     *
     * @return string
     */
    public function getChapo(): string
    {
        return $this->chapo;
    }

    /**
     * Method setContenu
     *
     * @param string $contenu [Attribution du contenu]
     *
     * @return self
     */
    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Affichage du contenu
     *
     * @return string
     */
    public function getContenu(): string
    {
        return $this->contenu;
    }

    /**
     * Method setDateCreation
     *
     * @param DateTime $dateCreation [Attribution de la date de création]
     *
     * @return self
     */
    public function setDateCreation(DateTime $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Affichage de la date de création
     *
     * @return DateTime
     */
    public function getDateCreation(): DateTime
    {
        return $this->dateCreation;
    }

    /**
     * Method setDateDerniereMaj
     *
     * @param DateTime $dateDerniereMaj [Attribution de la date de dernière MAJ]
     *
     * @return self
     */
    public function setDateDerniereMaj(DateTime $dateDerniereMaj): self
    {
        $this->dateDerniereMaj = $dateDerniereMaj;

        return $this;
    }

    /**
     * Affichage de la date de dernière MAJ
     *
     * @return DateTime
     */
    public function getDateDerniereMaj(): DateTime
    {
        return $this->dateDerniereMaj;
    }

    /**
     * Method setIdUtilisateur
     *
     * @param int $idUtilisateur [Attribution de l'ID utilisateur]
     *
     * @return self
     */
    public function setIdUtilisateur(int $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Affichage de l'ID utilisateur
     *
     * @return int
     */
    public function getIdUtilisateur(): int
    {
        return $this->idUtilisateur;
    }

}