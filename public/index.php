<?php

spl_autoload_register(function (string $fqcn) {
    $path = __DIR__ . '\\..\\src\\' . $fqcn . '.php';

    require_once($path);
});

use Controllers\HomeController;
use Controllers\UserController;
use Controllers\ArticleController;
use Controllers\CommentController;

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(-1);

session_start();

try {
    // Page d'accueil
    if (!isset($_GET["action"])) {
        $homeController = new HomeController();
        $homeController->homepage();
    } elseif (isset($_GET["action"])) {
        // Mise en place d'une session pour le token
        $userController = new UserController();
        // Page de connexion
        if ($_GET["action"] === "connexion") {
            $userController->connexion();
            // Page de retourConnexion
        } elseif ($_GET["action"] === "retourConnexion") {
            $userController->retourConnexion();
            // Page de déconnexion (retour à la page d'accueil + fermeture des sessions)
        } elseif ($_GET["action"] === "deconnexion") {
            $userController->deconnexion();
            // Page pour la création d'un compte utilisateur
        } elseif ($_GET["action"] === "creationCompte") {
            $userController->creationCompte();
            // Page sur l'affichage de l'ensemble des articles
        } elseif ($_GET["action"] === "retourCreationCompte") {
            $userController->retourCreationCompte();
            // Page sur l'affichage de l'ensemble des articles
        } elseif ($_GET["action"] === "affichageArticles") {
            $articleController = new ArticleController();
            $articleController->affichage();
        }
        if (isset($_GET["id"]) && $_GET["id"] > 0) {
            $id = $_GET["id"];
            // Page de modification d'un article
            if ($_GET["action"] === "read") {
                $articleController = new ArticleController();
                $articleController->read($id);
            }
        }
        // Action qui permet traiter les données sur l'ajour d'un commentaire
        // Si on se dirige vers cette page, alors, on doit avoir les droits user (minimum)
        if ($_GET["action"] === "comment") {
            if (isset($_SESSION["user"]["id"])) {
                $commentController = new CommentController();
                $commentController->comment();
                // Sinon, on est redirigé vers la page connexion
            } else {
                $userController = new UserController();
                $userController->connexion();
            }
        }
        // Actions que seul l'administrateur peut effectuer :
        if (isset($_SESSION["user"]["id"]) && $_SESSION["user"]["role"] === "admin") {
            $articleController = new ArticleController();
            // Page de l'affichage de l'ensemble des articles avec actions (edit, delete)
            if ($_GET["action"] === "gestionArticles") {
                $articleController->gestion();
                // Page pour ajouter un article
            } elseif ($_GET["action"] === "ajoutArticle") {
                $articleController->add();
                // Page pour traiter les données sur l'ajout d'un article
            } elseif ($_GET["action"] === "retourAjoutArticle") {
                $articleController->retourAdd($_FILES);
                // Page pour traiter les données sur la modification d'un article
            } elseif ($_GET["action"] === "retourEditArticle") {
                $articleController->retourEditArticle($_FILES);
                // Action qui permet de supprimer un article
            } elseif ($_GET["action"] === "delete") {
                $articleController->delete();
                // Action qui permet de se diriger vers la page de gestion des utilisateurs
            } elseif ($_GET["action"] === "gestionUtilisateurs") {
                $userController = new UserController();
                $userController->gestion();
                // Action qui permet traiter les données sur la validation d'un compte utilisateur
            } elseif ($_GET["action"] === "validateUser") {
                $userController = new UserController();
                $userController->validateUser();
                // Action qui permet de se diriger vers la page de gestion des commentaires
            } elseif ($_GET["action"] === "gestionCommentaires") {
                $commentController = new CommentController();
                $commentController->gestion();
                // Action qui permet traiter les données sur la validation d'un commentaire
            } elseif ($_GET["action"] === "validateComment") {
                $commentController = new CommentController();
                $commentController->validateComment();
            }
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                // Page de modification d'un article
                if ($_GET["action"] === "edit") {
                    $articleController->edit($id);
                }
            } else {
                throw new Exception("Erreur 404 : aucun identifiant d'article envoyé !");
            }
        } else {
            throw new Exception("Erreur 401 : vous n'avez pas l'autorisation d'accéder à cette page !");
        }
    } else {
        throw new Exception("Erreur 404 : La page que vous recherchez n'existe pas !");
    }
} catch (Exception $e) {
    $messageErreur = $e->getMessage();

    include_once(__DIR__ . '/../templates/erreur.php');
}