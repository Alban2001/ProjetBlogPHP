<?php

namespace Models;

use DateTime;
use Models\User;

class Comment
{
    /* 
     * Attributs de l'entité Comment
     */

    /**
     * @var integer Code
     */
    private int $code;

    /**
     * @var integer IdArticle
     */
    private int $idArticle;

    /**
     * @var string Contenu
     */
    private string $contenu;

    /**
     * La date de création est la date du jour par défaut lors de la création du commentaire
     * @var DateTime DateCreation
     */
    private DateTime $dateCreation;

    /**
     * @var integer Valide
     */
    private int $valide = 0;

    /**
     * @var integer IdUtilisateur
     */
    private int $idUtilisateur;

    /**
     * @var integer NomUtilisateur
     */
    private string $nomUtilisateur;

    /**
     * @var integer PrenomUtilisateur
     */
    private string $prenomUtilisateur;

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
     * Method setIdArticle
     *
     * @param int $idArticle [Attribution de l'ID article]
     *
     * @return self
     */
    public function setIdArticle(int $idArticle): self
    {
        $this->idArticle = $idArticle;

        return $this;
    }

    /**
     * Affichage de l'article
     *
     * @return int
     */
    public function getIdArticle(): int
    {
        return $this->idArticle;
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
     * Affichage de valide
     *
     * @return int
     */
    public function getValide(): int
    {
        return $this->valide;
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

    /**
     * Method setNomUtilisateur
     *
     * @param string $nomUtilisateur [Attribution du nom de l'utilisateur]
     *
     * @return self
     */
    public function setNomUtilisateur(string $nomUtilisateur): self
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    /**
     * Affichage du nom de l'utilisateur
     *
     * @return string
     */
    public function getNomUtilisateur(): string
    {
        return $this->nomUtilisateur;
    }

    /**
     * Method setPrenomUtilisateur
     *
     * @param string $prenomUtilisateur [Attribution du nom de l'utilisateur]
     *
     * @return self
     */
    public function setPrenomUtilisateur(string $prenomUtilisateur): self
    {
        $this->prenomUtilisateur = $prenomUtilisateur;

        return $this;
    }

    /**
     * Affichage du nom de l'utilisateur
     *
     * @return string
     */
    public function getPreomUtilisateur(): string
    {
        return $this->prenomUtilisateur;
    }
}