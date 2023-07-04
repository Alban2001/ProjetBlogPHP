<?php

namespace Models;

use Models\Comment;
use Lib\DatabaseConnection;
use DateTime;

class CommentManager
{
    //Permet d'ajouter un commentaire à l'article correspondant
    public function add(Comment $commentaire): void
    {
        $idArticle = $commentaire->getIdArticle();
        $contenu = $commentaire->getContenu();
        $valide = $commentaire->getValide();
        $idUtilisateur = $commentaire->getIdUtilisateur();

        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("INSERT INTO commentaire(id_article, contenu, date_creation,
valide, id_utilisateur) VALUES (?, ?, NOW(), ?, ?)");
        $statement->bindParam(1, $idArticle);
        $statement->bindParam(2, $contenu);
        $statement->bindParam(3, $valide);
        $statement->bindParam(4, $idUtilisateur);

        $statement->execute();
    }

    // Affichage de l'ensemble des commentaires de l'article correspondant
    public function getComments($idArticle)
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT contenu, date_creation, nom, prenom FROM commentaire, utilisateur WHERE id_article = ? AND commentaire.valide = 1 AND utilisateur.id = commentaire.id_utilisateur ORDER BY date_creation DESC");
        $statement->bindParam(1, $idArticle);
        $statement->execute();
        $commentaires = [];

        while (($row = $statement->fetch())) {
            $commentaire = new Comment();
            $commentaire
                ->setContenu($row['contenu'])
                ->setDateCreation(new DateTime($row['date_creation']))
                ->setNomUtilisateur($row['nom'])
                ->setPrenomUtilisateur($row['prenom'])
            ;
            $commentaires[] = $commentaire;
        }
        return $commentaires;
    }

    // Affichage du nombre de commentaires avec l'article correspondant
    public function nbrComments($idArticle): int
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT COUNT(id) AS 'nbrCommentaires' FROM commentaire WHERE id_article = ? AND valide = 1");
        $statement->bindParam(1, $idArticle);
        $statement->execute();
        $row = $statement->fetch();

        return $row["nbrCommentaires"];
    }

    // Affichage de l'ensemble des commentaires
    public function getAll(): array
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT C.*, nom, prenom FROM commentaire C, utilisateur WHERE utilisateur.id = C.id_utilisateur ORDER BY valide ASC");
        $statement->execute();
        $commentaires = [];

        while (($row = $statement->fetch())) {
            $commentaire = new Comment();
            $commentaire
                ->setId($row['id'])
                ->setIdArticle($row['id_article'])
                ->setContenu($row['contenu'])
                ->setDateCreation(new DateTime($row['date_creation']))
                ->setValide($row['valide'])
                ->setNomUtilisateur($row['nom'])
                ->setPrenomUtilisateur($row['prenom'])
            ;
            $commentaires[] = $commentaire;
        }
        return $commentaires;
    }

    // Permet de vérifier si l'ID du commentaire existe dans la BDD.
    public function verifierId($code): bool
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT id FROM commentaire WHERE id = ?");
        $statement->bindParam(1, $code);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            return true;
        }
        return false;
    }

    // Validation d'un commentaire
    public function valide(int $code): void
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("UPDATE commentaire SET valide = 1 WHERE id = ?");
        $statement->bindParam(1, $code);
        $statement->execute();
    }
}