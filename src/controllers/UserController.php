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
    // Vérifie aussi si ces données sont corrects et correspondent dans la BDD
    public function retourConnexion(array $input)
    {
        $numErreur = false;
        $userManager = new UserManager();
        $inputs = filter_input_array(INPUT_POST, $input);
        if ($userManager->verifierCompte($inputs["email"], $inputs["password"])) {
            session_start();
            $_SESSION["id"] = $userManager->getUser($inputs["email"], $inputs["password"])->getId();
            $_SESSION["nom"] = $userManager->getUser($inputs["email"], $inputs["password"])->getNom();
            $_SESSION["prenom"] = $userManager->getUser($inputs["email"], $inputs["password"])->getPrenom();
            $_SESSION["adresseMail"] = $userManager->getUser($inputs["email"], $inputs["password"])->getAdresseMail();
            $_SESSION["motDePasse"] = $userManager->getUser($inputs["email"], $inputs["password"])->getMotDePasse();
            $_SESSION["role"] = $userManager->getUser($inputs["email"], $inputs["password"])->getRole();

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