<?php

namespace Controllers;

use Models\UserManager;

class UserController
{
    // Direction vers la page de connexion pour la saisie de l'adresse mail et mot de passe
    public function connexion()
    {
        include_once(__DIR__ . '/../../templates/connexion.php');
    }

    // Permet de récupérer les données (adresse mail + mot de passe) de la page de connexion
    // Vérifie aussi si ces données sont correctes et correspondent dans la BDD
    public function retourConnexion()
    {
        $numErreur = false;
        $userManager = new UserManager();
        $options = array("email" => FILTER_SANITIZE_EMAIL, "password" => FILTER_SANITIZE_STRING);
        $inputs = filter_input_array(INPUT_POST, $options);
        if ($userManager->verifierCompte($inputs["email"], $inputs["password"])) {
            session_start();
            $user = $userManager->getUser($inputs["email"], $inputs["password"]);
            $_SESSION["user"]["id"] = $user->getId();
            $_SESSION["user"]["nom"] = $user->getNom();
            $_SESSION["user"]["prenom"] = $user->getPrenom();
            $_SESSION["user"]["adresseMail"] = $user->getAdresseMail();
            $_SESSION["user"]["motDePasse"] = $user->getMotDePasse();
            $_SESSION["user"]["role"] = $user->getRole();

            header("Location: index.php");
        } else {
            $numErreur = true;
            include_once(__DIR__ . '/../../templates/connexion.php');
        }
    }

    // Permet de se déconnecter du compte en supprimant les sessions existantes + retour à la page d'accueil
    public function deconnexion()
    {
        header("Location: index.php");
        include_once(__DIR__ . '/../../templates/accueil.php');
        session_destroy();
    }
}