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

    //Permet de vérifier si l'adresse mail est déjà présente dans la BDD
    public function verifierMail(string $adresseMail): bool
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT COUNT(adresse_mail) AS 'nbrLigne' FROM utilisateur WHERE adresse_mail = ?");
        $statement->bindParam(1, $adresseMail);
        $statement->execute();
        $row = $statement->fetch();

        if (($row["nbrLigne"] > 0)) {
            return false;
        }
        return true;
    }

    // Permet d'ajouter un nouvel utilisateur dans la BDD avec le role "user" par défaut
    // Ici, on va aussi crypté le mot de passe
    public function add(User $user): void
    {
        $nom = $user->getNom();
        $prenom = $user->getPrenom();
        $adresseMail = $user->getAdresseMail();
        $password = password_hash($user->getMotDePasse(), PASSWORD_DEFAULT);
        $role = $user->getRole();

        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("INSERT INTO utilisateur(nom, prenom, adresse_mail, mot_de_passe, role) VALUES (?, ?, ?, ?, ?)");
        $statement->bindParam(1, $nom);
        $statement->bindParam(2, $prenom);
        $statement->bindParam(3, $adresseMail);
        $statement->bindParam(4, $password);
        $statement->bindParam(5, $role);

        $statement->execute();
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

    //Permet d'obtenir toutes les informations d'un utilisateur (id, nom, prenom, adresse mail, mot de passe et rôle) avec un id en paramètre
    public function getUserById(int $id): User
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT * FROM utilisateur WHERE id = ?");
        $statement->bindParam(1, $id);
        $statement->execute();

        $row = $statement->fetch();

        $user = new User();
        $user
            ->setId($row['id'])
            ->setNom($row['nom'])
            ->setPrenom($row['prenom'])
        ;

        return $user;
    }
}