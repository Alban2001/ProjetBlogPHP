<?php

namespace Models;

use Models\User;
use Lib\DatabaseConnection;

class UserManager
{
    //Permet de vérifier si l'adresse mail et le mot de passe de l'utilisateur correspondent
    // Ici, pour le mot de passe, on va le comparer avec celui qui a été saisit par l'utilisateur et celui qui a été crypté dans la BDD
    public function verifierCompte(string $adresseMail, string $motDePasse): bool
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT adresse_mail, mot_de_passe FROM utilisateur WHERE adresse_mail = ?");
        $statement->bindParam(1, $adresseMail);
        $statement->execute();

        $row = $statement->fetch();

        if ((count($row) > 0) && ($adresseMail == $row["adresse_mail"]) && (password_verify($motDePasse, $row["mot_de_passe"]))) {
            return true;
        }

        return false;
    }

    //Permet d'obtenir toutes les informations d'un utilisateur (id, nom, prenom, adresse mail, mot de passe et rôle)
    public function getUser(string $adresseMail, string $motDePasse): User
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT * FROM utilisateur WHERE adresse_mail = ?");
        $statement->bindParam(1, $adresseMail);
        $statement->execute();

        $row = $statement->fetch();

        $user = new User();
        $user
            ->setId($row['id'])
            ->setNom($row['nom'])
            ->setPrenom($row['prenom'])
            ->setAdresseMail($row['adresse_mail'])
            ->setMotDePasse($motDePasse)
            ->setRole($row['role'])
        ;

        return $user;
    }
}