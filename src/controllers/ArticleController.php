<?php

namespace Controllers;

use Models\Article;
use Models\ArticleManager;
use Models\CommentManager;
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
        $inputs = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $idUtilisateur = $_SESSION["user"]["id"];

        if (!empty($inputs["token"]) && $inputs["token"] === $_SESSION["token"]) {
            // On vérifie que tout les champs ne sont pas vides
            if (!empty($inputs["title"]) && !empty($inputs["chapo"]) && !empty($inputs["content"]) && !empty($img["image"]["name"])) {
                $articleManager = new ArticleManager();
                $image = $articleManager->addImage($img);
                if (!empty($image)) {
                    $articleManager = new ArticleManager();
                    $objetArticle = new Article();
                    $objetArticle
                        ->setTitre($inputs["title"])
                        ->setImage($image)
                        ->setChapo($inputs["chapo"])
                        ->setContenu($inputs["content"])
                        ->setIdUtilisateur($idUtilisateur)
                    ;
                    $articleManager->add($objetArticle);
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
        } else {
            throw new Exception("Erreur 405 : la requête effectuée n'est pas autorisée !");
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
        $inputs = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $idUtilisateur = $_SESSION["user"]["id"];
        $idArticle = $_SESSION["article"]["id"];

        if (!empty($inputs["token"]) && $inputs["token"] === $_SESSION["token"]) {
            // On vérifie que tout les champs ne sont pas vides
            if (!empty($inputs["title"]) && !empty($inputs["chapo"]) && !empty($inputs["content"])) {
                $objetArticle = new Article();
                $objetArticle
                    ->setId($idArticle)
                    ->setTitre($inputs["title"])
                    ->setChapo($inputs["chapo"])
                    ->setContenu($inputs["content"])
                    ->setIdUtilisateur($idUtilisateur)
                ;
                // Si je mets une nouvelle image, alors :
                if (!empty($img["image"]["name"])) {
                    $article = $articleManager->getArticle($idArticle);
                    $image = $articleManager->addImage($img);

                    if (!empty($image)) {
                        $objetArticle->setImage($image);
                        $articleManager->update($objetArticle);
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
                    $objetArticle->setImage($image);
                    $articleManager->update($objetArticle);
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
        } else {
            throw new Exception("Erreur 405 : la requête effectuée n'est pas autorisée !");
        }
    }
    // Permet de supprimer un article de la BDD
    public function delete()
    {
        $options = array(
            "id" => FILTER_SANITIZE_NUMBER_INT,
            "token" => FILTER_DEFAULT
        );
        $inputs = filter_input_array(INPUT_POST, $options);
        if (!empty($inputs["token"]) && $inputs["token"] === $_SESSION["token"]) {
            $articleManager = new ArticleManager();
            if ($articleManager->verifierId($inputs["id"])) {
                // On va aussi supprimer en même temps, l'image dans le dossier upload
                // car celle-ci ne sera plus utilisée par la BDD
                $article = $articleManager->getArticle($inputs["id"]);
                unlink(__DIR__ . "/../../public/images/upload/" . $article->getImage());
                $articleManager->delete($inputs["id"]);
                $articles = $articleManager->getAll();
                header("Location: index.php?action=gestionArticles&successDelete=1");
            } else {
                throw new Exception("Erreur 404 : l'identifiant de cet article n'existe pas !");
            }
        } else {
            throw new Exception("Erreur 405 : la requête effectuée n'est pas autorisée !");
        }
    }

    // Permet d'afficher l'ensemble des articles
    public function affichage()
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAll();
        include_once(__DIR__ . "/../../templates/articles/affichage.php");
    }

    // Affichage l'ensemble des informations de l'article sélectionné + formulaire pour commentaire
    public function read($id)
    {
        $articleManager = new ArticleManager();
        if ($articleManager->verifierId($id)) {
            $userManager = new UserManager();
            $commentManager = new CommentManager();
            $article = $articleManager->getArticle($id);
            $user = $userManager->getUserById($article->getIdUtilisateur());
            $_SESSION["article"]["id"] = $article->getId();
            $commentaires = $commentManager->getComments($id);
            $nbrCommentaire = $commentManager->nbrComments($id);
            include_once(__DIR__ . "/../../templates/articles/read.php");
        } else {
            throw new Exception("Erreur 404 : l'identifiant de cet article n'existe pas !");
        }
    }
}