<?php

namespace Lib;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/SMTP.php';
require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/../config.php';

class Email
{
    /**
     * Méthode permettant d'envoyer un mail
     *
     * @param $expediteur $expediteur [nom et prénom de l'expéditeur]
     * @param $email $email [adresse mail de l'expéditeur]
     * @param $object $object [objet du message]
     * @param $body $body [message complet du mail]
     *
     * @return void
     */
    function sendEmail($expediteur, $email, $object, $body)
    {
        $mail = new PHPMailer(true);

        // Paramétrage du serveur
        // $mail->SMTPDebug = 3;
        $mail->isSMTP(); // Utilisateur du protocole SMTP
        $mail->Host = $_ENV["SMTP_HOST"]; // Nom du serveur SMTP
        $mail->SMTPAuth = true; // Activation SMTP
        $mail->Username = $_ENV["SMTP_USERNAME"]; // Nom d'utilisateur/email SMTP
        $mail->Password = $_ENV["SMTP_PASSWORD"]; // Mot de passe SMTP
        $mail->SMTPSecure = $_ENV["SMTP_SECURE"]; // Type de chiffrement;
        $mail->Port = $_ENV["SMTP_PORT"]; // Port TCP 

        $mail->setFrom($email); // Utilisateur expéditeur
        $mail->addAddress('alban.voiriot@gmail.com', 'Alban VOIRIOT'); // Utilisateur destinataire

        // Contenu du mail
        $mail->isHTML(true);
        $mail->Subject = $object;
        $mail->Body = $expediteur . " vous a envoyé un message : <br><br>" . $body;

        // Envoi du mail
        $mail->send();
    }
}