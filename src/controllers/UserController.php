<?php

namespace Controllers;

use Models\UserManager;

class UserController
{
    // Direction vers la page de connexion pour la saisit de l'adresse mail et mot de passe
    public function connexion()
    {
        include_once(__DIR__ . '/../../templates/connexion.php');
    }

    // Permet de récupérer les données (adresse mail + mot de passe) de la page de connexion
    // Vérifie aussi si ces données sont corrects et correspondent dans la BDD
    public function retourConnexion(array $input)
    {
        $userManager = new UserManager();
        if ($userManager->verifierCompte($input["email"], $input["password"])) {
            session_start();

            $_SESSION["nom"] = $userManager->getUser($input["email"], $input["password"])->getNom();
            $_SESSION["prenom"] = $userManager->getUser($input["email"], $input["password"])->getPrenom();
            $_SESSION["adresseMail"] = $userManager->getUser($input["email"], $input["password"])->getAdresseMail();
            $_SESSION["motDePasse"] = $userManager->getUser($input["email"], $input["password"])->getMotDePasse();
            $_SESSION["role"] = $userManager->getUser($input["email"], $input["password"])->getRole();

            header("Location: index.php");
        } else {
            header("Location: index.php?action=connexion");
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