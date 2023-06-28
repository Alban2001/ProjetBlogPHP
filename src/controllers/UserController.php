<?php

namespace Controllers;

use Models\User;
use Models\UserManager;
use Exception;

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
        $options = array(
            "email" => FILTER_SANITIZE_EMAIL,
            "password" => FILTER_DEFAULT,
            "token" => FILTER_DEFAULT
        );
        $inputs = filter_input_array(INPUT_POST, $options);
        if (!empty($inputs["token"]) && $inputs["token"] === $_SESSION["token"]) {
            $userManager = new UserManager();
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
        } else {
            throw new Exception("Erreur 405 : la requête effectuée n'est pas autorisée !");
        }
    }

    // Direction vers la page de création de compte pour les nouveaux utilisateurs
    public function creationCompte()
    {
        include_once(__DIR__ . '/../../templates/creationCompte.php');
    }

    // Permet de récupérer les données (nom, prénom, adresse mail, mot de passe) de la page de création de compte
    // Vérifie aussi si ces données sont correctes au niveau du format
    public function retourCreationCompte()
    {
        $erreurChamp = false;
        $erreurMail = false;
        $erreurMailExistant = false;
        $erreurPassword = false;
        $erreurPasswordConfirmed = false;
        $options = array(
            "nom" => FILTER_DEFAULT,
            "prenom" => FILTER_DEFAULT,
            "email" => FILTER_SANITIZE_EMAIL,
            "password" => FILTER_DEFAULT,
            "passwordConfirmed" => FILTER_DEFAULT,
            "token" => FILTER_DEFAULT
        );
        $inputs = filter_input_array(INPUT_POST, $options);
        if (!empty($inputs["token"]) && $inputs["token"] === $_SESSION["tokenCompte"]) {
            // Si les champs ne sont pas vides
            if (!empty($inputs["nom"]) && !empty($inputs["prenom"]) && !empty($inputs["email"]) && !empty($inputs["password"]) && !empty($inputs["passwordConfirmed"])) {
                // Si l'adresse mail respecte le bon format
                if (filter_var($inputs["email"], FILTER_VALIDATE_EMAIL)) {
                    $userManager = new UserManager();
                    // Si l'adresse mail n'existe pas dans la BDD
                    if ($userManager->verifierMail($inputs["email"]) === true) {
                        // Si le mot de passe doit contenir au moins 8 caractères, un chiffre, une lettre minuscule, une majuscule et un caractères spéciaux
                        if (
                            strlen($inputs["password"]) >= 12 &&
                            preg_match("/[a-z]/", $inputs["password"]) &&
                            preg_match("/[A-Z]/", $inputs["password"]) &&
                            preg_match("/[0-9]/", $inputs["password"]) &&
                            preg_match("/[?!@#$%^&*)(+=~.;:_-]/", $inputs["password"])
                        ) {
                            // Si le mot de passe saisit correspond au mot de passe de confirmation
                            if ($inputs["password"] === $inputs["passwordConfirmed"]) {
                                $user = new User();
                                $user
                                    ->setNom($inputs["nom"])
                                    ->setPrenom($inputs["prenom"])
                                    ->setAdresseMail($inputs["email"])
                                    ->setMotDePasse($inputs["password"])
                                ;
                                $userManager->add($user);
                                header("Location: index.php?action=creationCompte&success=1");
                            } else {
                                $erreurPasswordConfirmed = true;
                                include_once(__DIR__ . '/../../templates/creationCompte.php');
                            }
                        } else {
                            $erreurPassword = true;
                            include_once(__DIR__ . '/../../templates/creationCompte.php');
                        }
                    } else {
                        $erreurMailExistant = true;
                        include_once(__DIR__ . '/../../templates/creationCompte.php');
                    }
                } else {
                    $erreurMail = true;
                    include_once(__DIR__ . '/../../templates/creationCompte.php');
                }
            } else {
                $erreurChamp = true;
                include_once(__DIR__ . '/../../templates/creationCompte.php');
            }
        } else {
            throw new Exception("Erreur 405 : la requête effectuée n'est pas autorisée !");
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