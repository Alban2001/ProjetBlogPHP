<?php

namespace Controllers;

use Exception;
use Lib\Email;
use Lib\Globals;

class HomeController
{
    /**
     * Affichage de la page d'accueil
     *
     * @return void
     */
    public function homepage()
    {
        include_once __DIR__ . '/../../templates/accueil.php';
    }

    /**
     * Envoi d'un mail de l'utilisateur à l'auteur du site
     *
     * @return void
     */
    public function sendMail()
    {
        $options = array(
            "nomPrenom" => FILTER_DEFAULT,
            "email" => FILTER_SANITIZE_EMAIL,
            "objet" => FILTER_DEFAULT,
            "message" => FILTER_DEFAULT,
            "token" => FILTER_DEFAULT
        );
        $globals = new Globals();
        $globals->setPOST($options);
        $inputs = $globals->getPOST();

        if (empty($inputs["token"]) === false && $inputs["token"] === $_SESSION["token"]) {
            // Si les champs ne sont pas vides
            if (empty($inputs["nomPrenom"]) === false && empty($inputs["email"]) === false && empty($inputs["objet"]) === false && empty($inputs["message"]) === false) {
                // Si l'adresse mail saisie respecte le bon format d'une adresse mail : exemple@mail.fr
                if (filter_var($inputs["email"], FILTER_VALIDATE_EMAIL)) {
                    $mail = new Email();
                    $mail->sendEmail($inputs["nomPrenom"], $inputs["email"], $inputs["objet"], $inputs["message"]);
                    $messageSuccess = true;
                    $inputs = "";
                    include_once __DIR__ . '/../../templates/accueil.php';
                } else {
                    $erreurMail = true;
                    include_once __DIR__ . '/../../templates/accueil.php';
                }
            } else {
                $erreurChamp = true;
                include_once __DIR__ . '/../../templates/accueil.php';
            }
        } else {
            throw new Exception("Erreur 405 : la requête effectuée n'est pas autorisée !");
        }
    }
}