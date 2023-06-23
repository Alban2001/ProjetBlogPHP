<?php

namespace Models;

use Models\Article;
use Lib\DatabaseConnection;
use DateTime;
use PDO;

class ArticleManager
{
    //Permet de vérifier si l'adresse mail et le mot de passe de l'utilisateur correspondent
    // Ici, pour le mot de passe, on va le comparer avec celui qui a été saisit par l'utilisateur et celui qui a été crypté dans la BDD
    public function add(string $title, string $image, string $chapo, string $content, int $idUtilisateur): void
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("INSERT INTO article(titre, image, chapo, contenu, date_creation, date_derniere_maj, id_utilisateur) VALUES (?, ?, ?, ?, NOW(), NOW(), ?)");
        $statement->bindParam(1, $title);
        $statement->bindParam(2, $image);
        $statement->bindParam(3, $chapo);
        $statement->bindParam(4, $content);
        $statement->bindParam(5, $idUtilisateur);

        $statement->execute();
    }

    // Affichage de l'ensemble des articles du plus récent au plus ancien
    public function getAll(): array
    {
        $connection = new DatabaseConnection();
        // return $connection->getConnection()->query('SELECT * FROM article ORDER BY date_creation DESC')->fetchAll(PDO::FETCH_CLASS, 'Models\Article');

        $statement = $connection->getConnection()->prepare("SELECT * FROM article ORDER BY date_creation DESC");
        $statement->execute();
        $articles = [];

        while (($row = $statement->fetch())) {
            $article = new Article();

            $article
                ->setId($row['id'])
                ->setTitre($row['titre'])
                ->setImage($row['image'])
                ->setChapo($row['chapo'])
                ->setDateCreation(new DateTime($row['date_creation']))
                ->setDateDerniereMaj(new DateTime($row['date_derniere_maj']))
            ;
            $articles[] = $article;
        }
        return $articles;
    }
    // Affichage de l'ensemble des articles du plus récent au plus ancien
    public function getArticle($id): Article
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT * FROM article WHERE id = ?");
        $statement->bindParam(1, $id);
        $statement->execute();
        $row = $statement->fetch();

        $article = new Article();
        $article
            ->setId($row['id'])
            ->setTitre($row['titre'])
            ->setImage($row['image'])
            ->setChapo($row['chapo'])
            ->setContenu($row['contenu'])
            ->setDateCreation(new DateTime($row['date_creation']))
            ->setDateDerniereMaj(new DateTime($row['date_derniere_maj']))
            ->setIdUtilisateur($row['id_utilisateur'])
        ;

        return $article;
    }

    // Permet de vérifier si l'ID de l'article existe dans la BDD.
    // Ca permettra d'éviter que l'utilisateur saisit un id au hasard dans le paramètre de l'URL et de générer un message d'erreur PHP
    public function verifierId($id): bool
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT id FROM article WHERE id = ?");
        $statement->bindParam(1, $id);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            return true;
        }
        return false;
    }

    // Affichage de l'ensemble des articles du plus récent au plus ancien
    public function update($id, $titre, $image, $chapo, $contenu, $idUtilisateur)
    {
        $connection = new DatabaseConnection();
        if ($image === "") { // Si l'utilisateur n'a pas changé l'image, on ne rajoute pas la colonne (image = ?) dans la requête UPDATE
            $statement = $connection->getConnection()->prepare("UPDATE article SET titre = :titre, chapo = :chapo, contenu = :contenu, date_derniere_maj = NOW(), id_utilisateur = :idUser WHERE id = :id");
        } else { // Sinon, on met à jour tout les champs de la table
            $statement = $connection->getConnection()->prepare("UPDATE article SET titre = :titre, image = :image, chapo = :chapo, contenu = :contenu, date_derniere_maj = NOW(), id_utilisateur = :idUser WHERE id = :id");
            $statement->bindParam("image", $image);
        }
        $statement->bindParam("titre", $titre);
        $statement->bindParam("chapo", $chapo);
        $statement->bindParam("contenu", $contenu);
        $statement->bindParam("idUser", $idUtilisateur);
        $statement->bindParam("id", $id);
        $statement->execute();
    }
}