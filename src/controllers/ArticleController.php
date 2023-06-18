<?php

namespace Controllers;

use Models\ArticleManager;

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
                header("Location: index.php?action=gestionArticles");

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
}