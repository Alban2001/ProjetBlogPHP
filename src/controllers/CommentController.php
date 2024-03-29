<?php

namespace Controllers;

use Exception;
use Models\Comment;
use Models\CommentManager;
use Lib\Globals;

class CommentController
{
    /**
     * Permet d'ajouter un commentaire pour l'article correspondant
     *
     * @return void
     */
    function comment()
    {
        $options = array(
            "commentaire" => FILTER_DEFAULT,
            "token" => FILTER_DEFAULT
        );
        $globals = new Globals();
        $globals->setPOST($options);
        $inputs = $globals->getPOST();

        $idArticle = $_SESSION["article"]["id"];
        $idUtilisateur = $_SESSION["user"]["id"];

        if (empty($inputs["token"]) === false && $inputs["token"] === $_SESSION["token"]) {
            // Si le commentaire n'est pas rempli
            if (empty($inputs["commentaire"]) === false) {
                $commentManager = new CommentManager();
                $objetComment = new Comment();
                $objetComment
                    ->setIdArticle($idArticle)
                    ->setContenu($inputs["commentaire"])
                    ->setIdUtilisateur($idUtilisateur)
                ;
                $commentManager->add($objetComment);
                $commentaires = $commentManager->getComments($idArticle);
                // Nombre de commentaires au total sur l'article demandé
                $nbrCommentaire = $commentManager->nbrComments($idArticle);
                header("Location: index.php?action=read&id=" . $idArticle . "&success=1");
            } else {
                header("Location: index.php?action=read&id=" . $idArticle . "&messageErreur=1");
            }
        } else {
            throw new Exception("Erreur 405 : la requête effectuée n'est pas autorisée !");
        }
    }

    /**
     * Permet d'afficher l'ensemble des commentaires
     *
     * @return void
     */
    public function gestion()
    {
        $commentManager = new CommentManager();
        $commentaires = $commentManager->getAll();
        include_once __DIR__ . "/../../templates/gestionComments.php";
    }

    /**
     * Permet de récupérer les données sur la gestion des commentaires pour leur validation
     *
     * @return void
     */
    public function validateComment()
    {
        $options = array(
            "id" => FILTER_SANITIZE_NUMBER_INT,
            "token" => FILTER_DEFAULT
        );
        $globals = new Globals();
        $globals->setPOST($options);
        $inputs = $globals->getPOST();
        if (empty($inputs["token"]) === false && $inputs["token"] === $_SESSION["token"]) {
            $commentManager = new CommentManager();
            if ($commentManager->verifierId($inputs["id"]) === true) {
                $commentManager->valide($inputs["id"]);
                $commentaires = $commentManager->getAll();
                header("Location: index.php?action=gestionCommentaires&successValidate=1");
            } else {
                throw new Exception("Erreur 404 : l'identifiant de ce commentaire n'existe pas !");
            }
        } else {
            throw new Exception("Erreur 405 : la requête effectuée n'est pas autorisée !");
        }
    }
}