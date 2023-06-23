<?php

namespace Controllers;

use Models\ArticleManager;
use Models\UserManager;
use Exception;

class ArticleController
{
    // Permet d'afficher l'ensemble des articles pour sa gestion (modification, suppression)
    public function gestion()
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAll();
        include_once(__DIR__ . "/../../templates/articles/gestion.php");
    }

    // Permet de se diriger vers la page pour ajouter un nouvel article
    public function add()
    {
        include_once(__DIR__ . "/../../templates/articles/add.php");
    }

    // Permet de récupérer les données saisies de la page add.php, de les traiter et de faire une insertion dans la BDD
    public function retourAdd(array $img)
    {
        $numErreur = false;
        $erreurExtension = false;
        $options = array(
            "title" => FILTER_DEFAULT,
            "image" => FILTER_DEFAULT,
            "chapo" => FILTER_DEFAULT,
            "content" => FILTER_DEFAULT
        );
        $inputs = filter_input_array(INPUT_POST);
        $idUtilisateur = $_SESSION["user"]["id"];

        // On vérifie que tout les champs ne sont pas vides
        if (!empty($inputs["title"]) && !empty($inputs["chapo"]) && !empty($inputs["content"]) && !empty($img["image"]["name"])) {
            $chercheExtension = explode(".", $img["image"]["name"]);
            $extension = strtolower(end($chercheExtension)); // Récupère le dernier mot du tableau (donc l'extension du fichier)
            $emplacementOrigine = $img["image"]["tmp_name"]; // Récupère le chemin complet du fichier temporaire du serveur
            $extensions = ["jpg", "jpeg", "png"]; // Extensions d'image accepté

            // On vérifie que l'extension choisie fait partie des extensions autorisées (jpg, jpeg ou png)
            if (in_array($extension, $extensions)) {
                $nomImage = uniqid('', true); // Génère un id unique pour le nom de l'image
                $image = $nomImage . "." . $extension;
                // Définit le nouveau de destination pour les images uploadées
                $emplacementDestination = __DIR__ . "/../../public/images/upload/" . $image;

                $articleManager = new ArticleManager();
                $articleManager->add($inputs["title"], $image, $inputs["chapo"], $inputs["content"], intval($idUtilisateur));
                move_uploaded_file($emplacementOrigine, $emplacementDestination);
                $articles = $articleManager->getAll();
                header("Location: index.php?action=gestionArticles&successInsert=1");

            } else {
                $erreurExtension = true;
                $messageErreur = "Ce type d'extension n'est pas accepté. Extensions autorisées : jpg, jpeg ou png";
                include_once(__DIR__ . '/../../templates/articles/add.php');
            }
        } else {
            $numErreur = true;
            include_once(__DIR__ . '/../../templates/articles/add.php');
        }
    }

    // Permet de se diriger vers la page pour éditer un article
    public function edit($id)
    {
        $articleManager = new ArticleManager();
        $userManager = new UserManager();
        if ($articleManager->verifierId($id)) {
            $article = $articleManager->getArticle($id);
            $user = $userManager->getUserById($article->getIdUtilisateur());
            $_SESSION["article"]["id"] = $article->getId();
            include_once(__DIR__ . "/../../templates/articles/edit.php");
        } else {
            throw new Exception("Erreur 404 : l'identifiant de cet article n'existe pas !");
        }
    }

    // Permet de récupérer les données saisies de la page edit.php, de les traiter et de faire une insertion dans la BDD
    public function retourEditArticle(array $img)
    {
        $articleManager = new ArticleManager();
        $numErreur = false;
        $erreurExtension = false;
        $options = array(
            "title" => FILTER_DEFAULT,
            "image" => FILTER_DEFAULT,
            "chapo" => FILTER_DEFAULT,
            "content" => FILTER_DEFAULT
        );
        $inputs = filter_input_array(INPUT_POST);
        $idUtilisateur = $_SESSION["user"]["id"];
        $idArticle = $_SESSION["article"]["id"];

        // On vérifie que tout les champs ne sont pas vides
        if (!empty($inputs["title"]) && !empty($inputs["chapo"]) && !empty($inputs["content"])) {
            // Si je mets une nouvelle image, alors :
            if (!empty($img["image"]["name"])) {
                $article = $articleManager->getArticle($idArticle);
                $chercheExtension = explode(".", $img["image"]["name"]);
                $extension = strtolower(end($chercheExtension)); // Récupère le dernier mot du tableau (donc l'extension du fichier)
                $emplacementOrigine = $img["image"]["tmp_name"]; // Récupère le chemin complet du fichier temporaire du serveur
                $extensions = ["jpg", "jpeg", "png"]; // Extensions d'image accepté

                // On vérifie que l'extension choisie fait partie des extensions autorisées (jpg, jpeg ou png)
                if (in_array($extension, $extensions)) {
                    $nomImage = uniqid('', true); // Génère un id unique pour le nom de l'image
                    $image = $nomImage . "." . $extension;
                    // Définit le nouveau de destination pour les images uploadées
                    $emplacementDestination = __DIR__ . "/../../public/images/upload/" . $image;

                    $articleManager->update($idArticle, $inputs["title"], $image, $inputs["chapo"], $inputs["content"], $idUtilisateur);
                    move_uploaded_file($emplacementOrigine, $emplacementDestination);
                    // Permet de supprimer l'ancienne image du dossier upload, car celle-ci ne sera plus utilisée
                    // Permet d'éviter un nombre important d'images (encombrement) surtout quand elles ne sont pas utilisées
                    unlink(__DIR__ . "/../../public/images/upload/" . $article->getImage());
                    $articles = $articleManager->getAll();
                    header("Location: index.php?action=gestionArticles&successUpdate=1");
                    unset($_SESSION["article"]);

                } else {
                    $userManager = new UserManager();
                    $user = $userManager->getUserById($article->getIdUtilisateur());
                    $erreurExtension = true;
                    $messageErreur = "Ce type d'extension n'est pas accepté. Extensions autorisées : jpg, jpeg ou png";
                    include_once(__DIR__ . '/../../templates/articles/edit.php');
                }
                // Sinon, si je ne change pas l'image, je ne mets pas la colonne image dans la requête UPDATE
                // (ça évitera de duppliquer la même image dans le dossier upload)
            } else {
                $image = "";
                $articleManager->update($idArticle, $inputs["title"], $image, $inputs["chapo"], $inputs["content"], $idUtilisateur);
                $articles = $articleManager->getAll();
                header("Location: index.php?action=gestionArticles&successUpdate=1");
                unset($_SESSION["article"]);
            }
        } else {
            $userManager = new UserManager();
            $article = $articleManager->getArticle($idArticle);
            $user = $userManager->getUserById($article->getIdUtilisateur());
            $numErreur = true;
            include_once(__DIR__ . '/../../templates/articles/edit.php');
        }
    }
}