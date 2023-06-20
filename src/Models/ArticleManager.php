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
}