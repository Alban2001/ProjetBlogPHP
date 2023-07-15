<?php

namespace Models;

use Models\User;
use Lib\DatabaseConnection;

class UserManager
{
    /**
     * Permet de vérifier si l'adresse mail et le mot de passe de l'utilisateur correspondent
     * Ici, pour le mot de passe, on va le comparer avec celui qui a été saisit par l'utilisateur et celui qui a été crypté dans la BDD
     *
     * @param string $adresseMail [adresse mail de l'utilisateur saisie]
     * @param string $motDePasse [mot de passe de l'utilisateur saisi]
     *
     * @return bool
     */
    public function verifierCompte(string $adresseMail, string $motDePasse): bool
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT COUNT(id) AS 'nbr', adresse_mail, mot_de_passe FROM utilisateur WHERE adresse_mail = ? AND valide = 1");
        $statement->bindParam(1, $adresseMail);
        $statement->execute();
        $row = $statement->fetch();

        if (($row["nbr"]) > 0 && ($adresseMail == $row["adresse_mail"]) && (password_verify($motDePasse, $row["mot_de_passe"]))) {
            return true;
        }
        return false;
    }

    /**
     * Permet de vérifier si l'ID de l'utilisateur existe dans la BDD.
     *
     * @param $code $code [identifiant de l'utilisateur]
     *
     * @return bool
     */
    public function verifierId($code): bool
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT id FROM utilisateur WHERE id = ?");
        $statement->bindParam(1, $code);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Permet de vérifier si l'adresse mail est déjà présente dans la BDD
     *
     * @param string $adresseMail [adresse mail saisie de l'utilisateur]
     *
     * @return bool
     */
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

    /**
     * Permet d'ajouter un nouvel utilisateur dans la BDD avec le role "user" par défaut
     * Ici, on va aussi crypté le mot de passe
     *
     * @param User $user [objet user]
     *
     * @return void
     */
    public function add(User $user): void
    {
        $nom = $user->getNom();
        $prenom = $user->getPrenom();
        $adresseMail = $user->getAdresseMail();
        $password = password_hash($user->getMotDePasse(), PASSWORD_DEFAULT);
        $valide = $user->getValide();
        $role = $user->getRole();

        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("INSERT INTO utilisateur(nom, prenom, adresse_mail, mot_de_passe, valide, role) VALUES (?, ?, ?, ?, ?, ?)");
        $statement->bindParam(1, $nom);
        $statement->bindParam(2, $prenom);
        $statement->bindParam(3, $adresseMail);
        $statement->bindParam(4, $password);
        $statement->bindParam(5, $valide);
        $statement->bindParam(6, $role);

        $statement->execute();
    }

    /**
     * Validation du compte utilisateur
     *
     * @param int $code [identifiant de l'utilisateur]
     *
     * @return void
     */
    public function valide(int $code): void
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("UPDATE utilisateur SET valide = 1 WHERE id = ?");
        $statement->bindParam(1, $code);
        $statement->execute();
    }

    /**
     * Affichage de l'ensemble des utilisateurs
     *
     * @return array
     */
    public function getAll(): array
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT * FROM utilisateur ORDER BY valide ASC");
        $statement->execute();
        $users = [];

        while (($row = $statement->fetch())) {
            $user = new User();
            $user
                ->setId($row['id'])
                ->setNom($row['nom'])
                ->setPrenom($row['prenom'])
                ->setAdresseMail($row['adresse_mail'])
                ->setValide($row['valide'])
                ->setRole($row['role'])
            ;
            $users[] = $user;
        }
        return $users;
    }

    /**
     * Permet d'obtenir toutes les informations d'un utilisateur (id, nom, prenom, adresse mail, mot de passe et rôle)
     *
     * @param string $adresseMail [adresse mail saisie par l'utilisateur]
     * @param string $motDePasse [mot de passe saisi par l'utilisateur]
     *
     * @return User
     */
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

    /**
     * Permet d'obtenir toutes les informations d'un utilisateur (id, nom, prenom, adresse mail, mot de passe et rôle) avec un id en paramètre
     *
     * @param int $code [identifiant de l'utilisateur]
     *
     * @return User
     */
    public function getUserById(int $code): User
    {
        $connection = new DatabaseConnection();
        $statement = $connection->getConnection()->prepare("SELECT * FROM utilisateur WHERE id = ?");
        $statement->bindParam(1, $code);
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