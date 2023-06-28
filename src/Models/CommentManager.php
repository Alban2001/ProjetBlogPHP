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
        $statement = $connection->getConnection()->prepare("SELECT contenu, date_creation, nom, prenom FROM commentaire, utilisateur WHERE id_article = ? AND valide = 0 AND utilisateur.id = commentaire.id_utilisateur ORDER BY date_creation DESC");
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
        $statement = $connection->getConnection()->prepare("SELECT COUNT(id) AS 'nbrCommentaires' FROM commentaire WHERE id_article = ? AND valide = 0");
        $statement->bindParam(1, $idArticle);
        $statement->execute();
        $row = $statement->fetch();

        return $row["nbrCommentaires"];
    }
}