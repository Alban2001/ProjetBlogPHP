<?php

namespace Controllers;

use Exception;
use Models\Comment;
use Models\CommentManager;

class CommentController
{
    // Permet d'ajouter un commentaire pour l'article correspondant
    function comment()
    {
        $options = array(
            "commentaire" => FILTER_DEFAULT,
            "token" => FILTER_DEFAULT
        );
        $idArticle = $_SESSION["article"]["id"];
        $idUtilisateur = $_SESSION["user"]["id"];
        $inputs = filter_input_array(INPUT_POST, $options);

        if (!empty($inputs["token"]) && $inputs["token"] === $_SESSION["token"]) {
            if (!empty($inputs["commentaire"])) {
                $commentManager = new CommentManager();
                $objetComment = new Comment();
                $objetComment
                    ->setIdArticle($idArticle)
                    ->setContenu($inputs["commentaire"])
                    ->setIdUtilisateur($idUtilisateur)
                ;
                $commentManager->add($objetComment);
                $commentaires = $commentManager->getComments($idArticle);
                $nbrCommentaire = $commentManager->nbrComments($idArticle);
                header("Location: index.php?action=read&id=" . $idArticle . "&success=1");
            } else {
                header("Location: index.php?action=read&id=" . $idArticle . "&messageErreur=1");
            }
        } else {
            throw new Exception("Erreur 405 : la requête effectuée n'est pas autorisée !");
        }
    }
}