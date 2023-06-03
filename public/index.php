<?php

spl_autoload_register(function (string $fqcn) {
    $path = __DIR__ . '\\..\\src\\' . $fqcn . '.php';

    require_once($path);
});

use Controllers\HomeController;
use Controllers\UserController;

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(-1);

try {
    // Page d'accueil
    if (!isset($_GET["action"])) {
        $homeController = new HomeController();
        $homeController->homepage();
    } elseif (isset($_GET["action"])) {
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
        }
    } else {
        throw new Exception("La page que vous recherchez n'existe pas !");
    }
} catch (Exception $e) {
    $messageErreur = $e->getMessage();

    include_once(__DIR__ . '/../templates/erreur.php');
}