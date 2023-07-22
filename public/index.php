<?php

spl_autoload_register(function (string $fqcn) {
    $path = __DIR__ . '\\..\\src\\' . $fqcn . '.php';

    require_once($path);
});

use Controllers\HomeController;
use Controllers\UserController;
use Controllers\ArticleController;
use Controllers\CommentController;
use Lib\Globals;

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(-1);

session_start();

try {
    $globals = new Globals();
    $globals->setGET();
    $get_action = $globals->getGET("action");
    $get_id = $globals->getGET("id");

    // Page d'accueil
    if (!isset($get_action)) {
        $homeController = new HomeController();
        $homeController->homepage();
    } else if (isset($get_action)) {
        // Mise en place d'une session pour le token
        $userController = new UserController();
        // Page de connexion
        if ($get_action === "connexion") {
            $userController->connexion();
            // Page de retourConnexion
        } else if ($get_action === "retourConnexion") {
            $userController->retourConnexion();
            // Page de déconnexion (retour à la page d'accueil + fermeture des sessions)
        } else if ($get_action === "deconnexion") {
            $userController->deconnexion();
            // Page pour la création d'un compte utilisateur
        } else if ($get_action === "creationCompte") {
            $userController->creationCompte();
            // Page sur l'affichage de l'ensemble des articles
        } else if ($get_action === "retourCreationCompte") {
            $userController->retourCreationCompte();
            // Page sur l'affichage de l'ensemble des articles
        } else if ($get_action === "affichageArticles") {
            $articleController = new ArticleController();
            $articleController->affichage();
        } else if ($get_action === "sendEmail") {
            $homeController = new HomeController();
            $homeController->sendMail();
        }
        if (isset($get_id) && $get_id > 0) {
            $code = $get_id;
            // Page de modification d'un article
            if ($get_action === "read") {
                $articleController = new ArticleController();
                $articleController->read($code);
            }
        }
        // Action qui permet traiter les données sur l'ajour d'un commentaire
        // Si on se dirige vers cette page, alors, on doit avoir les droits user (minimum)
        if ($get_action === "comment") {
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
            if ($get_action === "gestionArticles") {
                $articleController->gestion();
                // Page pour ajouter un article
            } else if ($get_action === "ajoutArticle") {
                $articleController->add();
                // Page pour traiter les données sur l'ajout d'un article
            } else if ($get_action === "retourAjoutArticle") {
                $articleController->retourAdd();
                // Page pour traiter les données sur la modification d'un article
            } else if ($get_action === "retourEditArticle") {
                $articleController->retourEditArticle();
                // Action qui permet de supprimer un article
            } else if ($get_action === "delete") {
                $articleController->delete();
                // Action qui permet de se diriger vers la page de gestion des utilisateurs
            } else if ($get_action === "gestionUtilisateurs") {
                $userController = new UserController();
                $userController->gestion();
                // Action qui permet traiter les données sur la validation d'un compte utilisateur
            } else if ($get_action === "validateUser") {
                $userController = new UserController();
                $userController->validateUser();
                // Action qui permet de se diriger vers la page de gestion des commentaires
            } else if ($get_action === "gestionCommentaires") {
                $commentController = new CommentController();
                $commentController->gestion();
                // Action qui permet traiter les données sur la validation d'un commentaire
            } else if ($get_action === "validateComment") {
                $commentController = new CommentController();
                $commentController->validateComment();
            }
            if (isset($get_id) && $get_id > 0) {
                $code = $get_id;
                // Page de modification d'un article
                if ($get_action === "edit") {
                    $articleController->edit($code);
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