<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Inclure l'autoloader de Composer

if (!isset($_SESSION['id'])) {
    $titre = "Mot de passe oublié";
    $erreurs = [];

    if (isset($_POST["bouton-mdp"])) {
        if (empty($_POST['email-mdp']) || !filter_var($_POST['email-mdp'], FILTER_VALIDATE_EMAIL)) {
            $erreurs['email-mdp'] = "Erreur adresse mail vide ou invalide";
        }

        if (empty($erreurs)) {
            require "../src/data/db-connect.php";
            $email = $_POST['email-mdp'];
            $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE email = :email");
            $requete->execute(['email' => $email]);
            $ligne = $requete->fetch();

            if ($ligne) {
                $mail = new PHPMailer(true);

                try {
                    // Paramètres du serveur
                    $mail->SMTPDebug = 2;                                       // Activer le débogage détaillé
                    $mail->isSMTP();                                            // Utiliser SMTP
                    $mail->Host       = 'smtp.gmail.com';                       // Serveur SMTP
                    $mail->SMTPAuth   = true;                                   // Activer l'authentification SMTP
                    $mail->Username   = 'damien.etesse@stagiairesmns.fr';       // Adresse email SMTP
                    $mail->Password   = 'vuvx eqyu awxt qaev';  // Mot de passe SMTP
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Activer SSL
                    $mail->Port       = 465;                                    // Port SMTP pour SSL

                    // Destinataires
                    $mail->setFrom('damien.etesse@stagiairesmns.fr', 'LOC MNS');
                    $mail->addAddress($email);  // Ajouter un destinataire

                    // Contenu
                    $mail->isHTML(true);                                        // Email au format HTML
                    $mail->Subject = 'Réinitialisation de mot de passe';
                    $mail->Body    = 'Bonjour,<br><br>Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien suivant :<br><br>Ce lien expirera dans une heure.<br><br>Cordialement,<br>Loc MNS';
                    $mail->AltBody = 'Bonjour,\n\nPour réinitialiser votre mot de passe, veuillez cliquer sur le lien suivant :\n\nCe lien expirera dans une heure.\n\nCordialement,\nLoc MNS';

                    $mail->send();
                    echo 'Le message a été envoyé';
                } catch (Exception $e) {
                    echo "Le message n'a pas pu être envoyé. Erreur Mailer : {$mail->ErrorInfo}";
                }
            }
        }
    }
} else {
    header("Location: /");
}
