<?php

namespace Controllers;

use Models\Article;
use Models\ArticleManager;
use Models\CommentManager;
use Models\UserManager;
use Lib\Globals;
use Exception;

class ArticleController
{
    /**
     * Permet d'afficher l'ensemble des articles pour sa gestion (modification, suppression)
     *
     * @return void
     */
    public function gestion()
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAll();
        include_once __DIR__ . "/../../templates/articles/gestion.php";

    } //end gestion()


    /**
     * Permet de se diriger vers la page pour ajouter un nouvel article
     *
     * @return void
     */
    public function add()
    {
        include_once __DIR__ . "/../../templates/articles/add.php";
    }
    // end add()


    /**
     * Permet de récupérer les données saisies de la page add.php, de les traiter et de faire une insertion dans la BDD
     *
     * @return void
     */
    public function retourAdd()
    {
        $globals = new Globals();
        $globals->setPOST();
        $inputs = $globals->getPOST();

        $globals->setFILES();
        $img = $globals->getFILES();
        $idUtilisateur = $_SESSION["user"]["id"];

        if (empty($inputs["token"]) === false && $inputs["token"] === $_SESSION["token"]) {
            // On vérifie que tout les champs ne sont pas vides
            if (empty($inputs["title"]) === false && empty($inputs["chapo"]) === false && empty($inputs["content"]) === false && empty($img["image"]["name"]) === false) {
                $articleManager = new ArticleManager();
                $image = $articleManager->addImage($img);
                if (empty($image) === false) {
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
                    include_once __DIR__ . '/../../templates/articles/add.php';
                }
            } else {
                $numErreur = true;
                include_once __DIR__ . '/../../templates/articles/add.php';
            }
        } else {
            throw new Exception("Erreur 405 : la requête effectuée n'est pas autorisée !");
        }
    }

    /**
     * Permet de se diriger vers la page pour éditer un article
     *
     * @param $code $code [code de l'article]
     *
     * @return void
     */
    public function edit($code)
    {
        $articleManager = new ArticleManager();
        $userManager = new UserManager();
        if ($articleManager->verifierId($code) === true) {
            $article = $articleManager->getArticle($code);
            $user = $userManager->getUserById($article->getIdUtilisateur());
            $_SESSION["article"]["id"] = $article->getId();
            include_once __DIR__ . "/../../templates/articles/edit.php";
        } else {
            throw new Exception("Erreur 404 : l'identifiant de cet article n'existe pas !");
        }
    }

    /**
     * Permet de récupérer les données saisies de la page edit.php, de les traiter et de faire une insertion dans la BDD
     *
     * @return void
     */
    public function retourEditArticle()
    {
        $articleManager = new ArticleManager();
        $globals = new Globals();
        $globals->setPOST();
        $inputs = $globals->getPOST();

        $globals->setFILES();
        $img = $globals->getFILES();
        $idUtilisateur = $_SESSION["user"]["id"];
        $idArticle = $_SESSION["article"]["id"];

        if (empty($inputs["token"]) === false && $inputs["token"] === $_SESSION["token"]) {
            // On vérifie que tout les champs ne sont pas vides
            if (empty($inputs["title"]) === false && empty($inputs["chapo"]) === false && empty($inputs["content"]) === false) {
                $objetArticle = new Article();
                $objetArticle
                    ->setId($idArticle)
                    ->setTitre($inputs["title"])
                    ->setChapo($inputs["chapo"])
                    ->setContenu($inputs["content"])
                    ->setIdUtilisateur($idUtilisateur)
                ;
                // Si je mets une nouvelle image, alors :
                if (empty($img["image"]["name"]) === false) {
                    $article = $articleManager->getArticle($idArticle);
                    $image = $articleManager->addImage($img);

                    if (empty($image) === false) {
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
                        include_once __DIR__ . '/../../templates/articles/edit.php';
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
                include_once __DIR__ . '/../../templates/articles/edit.php';
            }
        } else {
            throw new Exception("Erreur 405 : la requête effectuée n'est pas autorisée !");
        }
    }

    /**
     * Permet de supprimer un article de la BDD
     *
     * @return void
     */
    public function delete()
    {
        $options = array(
            "id" => FILTER_SANITIZE_NUMBER_INT,
            "token" => FILTER_DEFAULT
        );
        $globals = new Globals();
        $globals->setPOST($options);
        $inputs = $globals->getPOST();

        if (!empty($inputs["token"]) && $inputs["token"] === $_SESSION["token"]) {
            $articleManager = new ArticleManager();
            if ($articleManager->verifierId($inputs["id"]) === true) {
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

    /**
     * Permet d'afficher l'ensemble des articles
     *
     * @return void
     */
    public function affichage()
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAll();
        include_once __DIR__ . "/../../templates/articles/affichage.php";
    }

    /**
     * Affichage de l'ensemble des informations de l'article sélectionné + formulaire pour écrire un commentaire
     *
     * @param $code $code [explicite description]
     *
     * @return void
     */
    public function read($code)
    {
        $articleManager = new ArticleManager();
        if ($articleManager->verifierId($code) === true) {
            $userManager = new UserManager();
            $commentManager = new CommentManager();
            $article = $articleManager->getArticle($code);
            $user = $userManager->getUserById($article->getIdUtilisateur());
            $_SESSION["article"]["id"] = $article->getId();
            $commentaires = $commentManager->getComments($code);
            $nbrCommentaire = $commentManager->nbrComments($code);
            include_once __DIR__ . "/../../templates/articles/read.php";
        } else {
            throw new Exception("Erreur 404 : l'identifiant de cet article n'existe pas !");
        }
    }
}