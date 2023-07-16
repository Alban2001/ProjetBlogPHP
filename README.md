# PROJET 5 : Blog Professionnel - Créez votre premier blog en PHP

**Date de création** : 03 juillet 2023
**Date de la dernière modification** : 16 juillet 2023
**Auteur** : Alban VOIRIOT
**Informations techniques** :

- **Langages** : HTML, CSS, PHP, SQL, JavaScript, Bootstrap, MySQL
- **Version de PHP** : 8.2.6
- **Version de MySQL** : 5.7.11
- **Version de Bootstrap** : 5.0.2

# Sommaire

- [Contexte](#contexte)
- [Installation](#installation)
  - [Télécharger le projet](#télécharger-le-projet)
  - [Configurer la base de données](#configurer-la-base-de-données)
  - [Dossier upload](#dossier-upload)
- [Guide d'utilisation](#guide-dutilisation)
  - [Compte administrateur](#compte-administrateur)

# Contexte

Ce projet a été conçu dans le cadre de ma formation de développeur d'applications PHP/Symfony (OpenClassrooms) sur la création d'un blog professionnel avec une présentation à propos de moi (parcours, CV, contact, ...) et une partie administration pour gérer les articles. Les utilisateurs pourront commenter les articles souhaités uniquement s'ils possèdent un compte utilisateur (et validé par l'administrateur). Dans ce blog, seul les utilisateurs ayant les droits admin peuvent créer, modifier, supprimer les articles et valider les commentaires ainsi que les nouveaux utilisateurs.

# Installation

### Télécharger le projet

=> Pour télécharger le dossier, veuillez effectuer la commande GIT : `git clone https://github.com/Alban2001/ProjetBlogPHP.git`

### Configurer la base de données

- => Mettez le nom de l'hôte (ex: localhost), nom de la base de données, nom de l'utilisateur et mot de passe dans le fichier **_config.php.dist_** qui se trouve dans le dossier **/src**.

```
$_ENV["DB_HOST"] = "nom de l'hôte";
$_ENV["DB_NAME"] = "nom de la bdd";
$_ENV["DB_USERNAME"] = "votre username";
$_ENV["DB_PASSWORD"] = "votre mot de passe";
```

Ces variables d'environnements viendront s'appliquer à la chaîne de connexion pour la connexion avec la base de données :

      ```
      $this->database = new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';dbname=' . $_ENV["DB_NAME"] . ';charset=utf8', $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"]);
      ```

- => Ensuite, veuillez renommer le fichier **_config.php.dist_** avec le nom suivant : **_config.php_** afin que ce fichier soit pris en compte lors de l'inclusion pour la DatabaseConnection.

- => Et pour finir, importez le fichier **_bdd_blogpro.sql_** qui se trouve à la racine du projet contenant l'ensemble des tables et les jeux de données.

### Dossier upload

Veuillez créer un dossier **_/upload_** dans le dossier **_/public/images/_**. Celui-ci va vous permettre de stocker les images de vos articles lors des ajouts et des modifications. Des articles ont déjà ajouté mais vous rendre compte que les images n'existent pas. Veuillez vous connecter en tant qu'administrateur [(lire la partie sur le compte administrateur)](#compte-administrateur) puis allez dans la gestion des articles et ajoutez vos propres images pour chaque article.

# Guide d'utilisation

### Compte administrateur

Afin de pouvoir tester les fonctionnalités de l'administrateur, vous devez vous connecter avec l'adresse mail _user@openclassrooms.fr_ puis saisir le mot de passe suivant : _UserOC2023?!_ . Ou bien, vous avez la possibilité de créer un compte (**_page se connecter > créer un compte_**) dont le rôle de l'utilisateur sera **_user_** par défault. Il faudra juste modifier directement les colonnes **_role_** en mettant la valeur _admin_ puis **_valide_** en mettant _1_ dans la table **_utilisateur_** sur votre ligne concerné.

```diff
- La valeur "valide" doit être absolument être à "1", car sinon vous ne pourrez pas vous connecter à votre compte, même si l'adresse mail et le mot de passe sont corrects !
```

L'administrateur pourra gérer les articles, les utilisateurs ainsi que les commentaires et il aura aussi la possibilité d'ajouter des commentaires sur un article choisi.
