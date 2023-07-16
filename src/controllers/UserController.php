<?php

namespace Controllers;

use Models\User;
use Models\UserManager;
use Exception;
use Lib\Globals;

class UserController
{
    /**
     * Direction vers la page de connexion pour la saisie de l'adresse mail et mot de passe
     *
     * @return void
     */
    public function connexion()
    {
        include_once __DIR__ . '/../../templates/connexion.php';
    }

    /**
     * Permet de récupérer les données (adresse mail + mot de passe) de la page de connexion
     * Permet de récupérer les données (adresse mail + mot de passe) de la page de connexion
     *
     * @return void
     */
    public function retourConnexion()
    {
        $options = array(
            "email" => FILTER_SANITIZE_EMAIL,
            "password" => FILTER_DEFAULT,
            "token" => FILTER_DEFAULT
        );
        $globals = new Globals();
        $globals->setPOST($options);
        $inputs = $globals->getPOST();
        if (empty($inputs["token"]) === false && $inputs["token"] === $_SESSION["token"]) {
            $userManager = new UserManager();
            // Si l'adresse mail et le mot de passe correspond
            if ($userManager->verifierCompte($inputs["email"], $inputs["password"]) === true) {
                session_start();
                $user = $userManager->getUser($inputs["email"], $inputs["password"]);
                $_SESSION["user"]["id"] = $user->getId();
                $_SESSION["user"]["nom"] = $user->getNom();
                $_SESSION["user"]["prenom"] = $user->getPrenom();
                $_SESSION["user"]["adresseMail"] = $user->getAdresseMail();
                $_SESSION["user"]["role"] = $user->getRole();

                header("Location: index.php");
            } else {
                $numErreur = true;
                include_once __DIR__ . '/../../templates/connexion.php';
            }
        } else {
            throw new Exception("Erreur 405 : la requête effectuée n'est pas autorisée !");
        }
    }

    /**
     * Direction vers la page de création de compte pour les nouveaux utilisateurs
     *
     * @return void
     */
    public function creationCompte()
    {
        include_once __DIR__ . '/../../templates/creationCompte.php';
    }

    /**
     * Permet de récupérer les données (nom, prénom, adresse mail, mot de passe) de la page de création de compte
     * Vérifie aussi si ces données sont correctes au niveau du format
     *
     * @return void
     */
    public function retourCreationCompte()
    {
        $options = array(
            "nom" => FILTER_DEFAULT,
            "prenom" => FILTER_DEFAULT,
            "email" => FILTER_SANITIZE_EMAIL,
            "password" => FILTER_DEFAULT,
            "passwordConfirmed" => FILTER_DEFAULT,
            "token" => FILTER_DEFAULT
        );
        $globals = new Globals();
        $globals->setPOST($options);
        $inputs = $globals->getPOST();
        if (empty($inputs["token"]) === false && $inputs["token"] === $_SESSION["tokenCompte"]) {
            // Si les champs ne sont pas vides
            if (empty($inputs["nom"]) === false && empty($inputs["prenom"]) === false && empty($inputs["email"]) === false && empty($inputs["password"]) === false && empty($inputs["passwordConfirmed"]) === false) {
                // Si l'adresse mail respecte le bon format
                if (filter_var($inputs["email"], FILTER_VALIDATE_EMAIL)) {
                    $userManager = new UserManager();
                    // Si l'adresse mail n'existe pas dans la BDD
                    if ($userManager->verifierMail($inputs["email"]) === true) {
                        // Si le mot de passe doit contenir au moins 8 caractères, un chiffre, une lettre minuscule, une majuscule et un caractères spéciaux
                        if (
                            strlen($inputs["password"]) >= 12
                            && preg_match("/[a-z]/", $inputs["password"])
                            && preg_match("/[A-Z]/", $inputs["password"])
                            && preg_match("/[0-9]/", $inputs["password"])
                            && preg_match("/[?!@#$%^&*)(+=~.;:_-]/", $inputs["password"])
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
                                $errorPwConfirmed = true;
                                include_once __DIR__ . '/../../templates/creationCompte.php';
                            }
                        } else {
                            $erreurPassword = true;
                            include_once __DIR__ . '/../../templates/creationCompte.php';
                        }
                    } else {
                        $erreurMailExistant = true;
                        include_once __DIR__ . '/../../templates/creationCompte.php';
                    }
                } else {
                    $erreurMail = true;
                    include_once __DIR__ . '/../../templates/creationCompte.php';
                }
            } else {
                $erreurChamp = true;
                include_once __DIR__ . '/../../templates/creationCompte.php';
            }
        } else {
            throw new Exception("Erreur 405 : la requête effectuée n'est pas autorisée !");
        }
    }

    /**
     * Permet d'afficher l'ensemble des utilisateurs (users + admin)
     *
     * @return void
     */
    public function gestion()
    {
        $userManager = new UserManager();
        $utilisateurs = $userManager->getAll();
        include_once __DIR__ . "/../../templates/gestionUsers.php";
    }

    /**
     * Permet de récupérer les données sur la gestion des utilisateurs pour la validation du compte
     *
     * @return void
     */
    public function validateUser()
    {
        $options = array(
            "id" => FILTER_SANITIZE_NUMBER_INT,
            "token" => FILTER_DEFAULT
        );
        $globals = new Globals();
        $globals->setPOST($options);
        $inputs = $globals->getPOST();
        if (empty($inputs["token"]) === false && $inputs["token"] === $_SESSION["token"]) {
            $userManager = new UserManager();
            if ($userManager->verifierId($inputs["id"]) === true) {
                $userManager->valide($inputs["id"]);
                $utilisateurs = $userManager->getAll();
                header("Location: index.php?action=gestionUtilisateurs&successValidate=1");
            } else {
                throw new Exception("Erreur 404 : l'identifiant de cet utilisateur n'existe pas !");
            }
        } else {
            throw new Exception("Erreur 405 : la requête effectuée n'est pas autorisée !");
        }
    }

    /**
     * Permet de se déconnecter du compte en supprimant les sessions existantes + retour à la page d'accueil
     *
     * @return void
     */
    public function deconnexion()
    {
        header("Location: index.php");
        include_once __DIR__ . '/../../templates/accueil.php';
        session_destroy();
    }
}