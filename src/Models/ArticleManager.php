<?php

namespace Models;

use Models\Article;
use Lib\DatabaseConnection;
use DateTime;
use PDO;

class ArticleManager
{
    /**
     * Permet de vérifier si l'adresse mail et le mot de passe de l'utilisateur correspondent
     * Ici, pour le mot de passe, on va le comparer avec celui qui a été saisit par l'utilisateur et celui qui a été crypté dans la BDD
     * 
     * @param Article $article [objet Article]
     *
     * @return void
     */
    public function add(Article $article): void
    {
        $titre = $article->getTitre();
        $image = $article->getImage();
        $chapo = $article->getChapo();
        $contenu = $article->getContenu();
        $idUtilisateur = $article->getIdUtilisateur();

        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("INSERT INTO article(titre, image, chapo, contenu, date_creation, date_derniere_maj, id_utilisateur) VALUES (?, ?, ?, ?, NOW(), NOW(), ?)");
        $statement->bindParam(1, $titre);
        $statement->bindParam(2, $image);
        $statement->bindParam(3, $chapo);
        $statement->bindParam(4, $contenu);
        $statement->bindParam(5, $idUtilisateur);

        $statement->execute();
    }

    /**
     * Permet de générer une image pour les articles
     *
     * @param array $img [variable globale $_FILES]
     *
     * @return string
     */
    public function addImage(array $img): string
    {
        $chercheExtension = explode(".", $img["image"]["name"]);
        $extension = strtolower(end($chercheExtension)); // Récupère le dernier mot du tableau (donc l'extension du fichier)
        $pathOrigine = $img["image"]["tmp_name"]; // Récupère le chemin complet du fichier temporaire du serveur
        $extensions = ["jpg", "jpeg", "png"]; // Extensions d'image accepté
        $typeFichier = ["image/jpg", "image/jpeg", "image/png"]; // types de fichier accepté

        if (in_array($extension, $extensions) === true && in_array(mime_content_type($img["image"]["tmp_name"]), $typeFichier) === true) {
            $nomImage = uniqid('', true); // Génère un id unique pour le nom de l'image
            $image = $nomImage . "." . $extension;
            // Définit le nouveau de destination pour les images uploadées
            $pathDestination = __DIR__ . "/../../public/images/upload/" . $image;
            move_uploaded_file($pathOrigine, $pathDestination);

            return $image;
        } else {
            return "";
        }
    }

    /**
     * Affichage de l'ensemble des articles du plus récent au plus ancien
     *
     * @return array
     */
    public function getAll(): array
    {
        $connection = new DatabaseConnection();
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

    /**
     * Affichage de l'ensemble des articles du plus récent au plus ancien
     *
     * @param $code $code [variable code de l'article]
     *
     * @return Article
     */
    public function getArticle($code): Article
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT * FROM article WHERE id = ?");
        $statement->bindParam(1, $code);
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

    /**
     * Permet de vérifier si l'ID de l'article existe dans la BDD.
     * Ca permettra d'éviter que l'utilisateur saisit un id au hasard dans le paramètre de l'URL et de générer un message d'erreur PHP
     *
     * @param $code $code [explicite description]
     *
     * @return bool
     */
    public function verifierId($code): bool
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT id FROM article WHERE id = ?");
        $statement->bindParam(1, $code);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Affichage de l'ensemble des articles du plus récent au plus ancien
     *
     * @param Article $article [objet Article]
     *
     * @return void
     */
    public function update(Article $article)
    {
        $code = $article->getId();
        $titre = $article->getTitre();
        $image = $article->getImage();
        $chapo = $article->getChapo();
        $contenu = $article->getContenu();
        $idUtilisateur = $article->getIdUtilisateur();

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
        $statement->bindParam("id", $code);
        $statement->execute();
    }

    /**
     * Permet de supprimer une ligne (article) avec les commentaires associées dans la BDD
     *
     * @param int $code [variable code de l'article]
     *
     * @return void
     */
    public function delete(int $code): void
    {
        $connection = new DatabaseConnection();
        // On supprimer tout d'abord, les commentaires (clés étrangères)
        $statement = $connection->getConnection()->prepare("DELETE FROM commentaire WHERE id_article = ?");
        $statement->bindParam(1, $code);
        $statement->execute();

        // Puis l'article que l'on souhaite
        $statement2 = $connection->getConnection()->prepare("DELETE FROM article WHERE id = ?");
        $statement2->bindParam(1, $code);
        $statement2->execute();
    }
}