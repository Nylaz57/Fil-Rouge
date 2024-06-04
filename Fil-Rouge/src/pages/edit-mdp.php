<?php
session_start();
if (isset($_SESSION['id'])) {

    $titre = "Changer mot de passe";

    if (isset($_POST['validation'])) {

        $erreurs = [];

        if (empty($_POST['old-password'])) {
            $erreurs['old-password'] = "Le mot de passe est obligatoire";
        }
        if (empty($_POST['new-password-1'])) {
            $erreurs['new-password-1'] = "Veuillez saisir votre nouveau mot de passe";
        }
        if (empty($_POST['new-password-2'])) {
            $erreurs['new-password-2'] = "Veuillez saisir votre nouveau mot de passe";
        }


        if (empty($erreurs)) {
            require "../src/data/db-connect.php";
            $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE Id_utilisateur = :Id_utilisateur");
            $requete->execute(['Id_utilisateur' => $_SESSION['id']]);
            $ligne = $requete->fetch();

            if ($ligne) {

                if (password_verify($_POST['old-password'], $ligne['password'])) {
                    if (($_POST['new-password-1']) === ($_POST['new-password-2'])) {
                        $nouveauMdp = password_hash($_POST['new-password-2'], PASSWORD_DEFAULT);
                        $requete = $connexion->prepare("UPDATE utilisateur SET password =:password WHERE Id_utilisateur=:Id_utilisateur");
                        $requete->execute([
                            'password' => $nouveauMdp,
                            'Id_utilisateur' => $_SESSION['id']
                        ]);
                        header("Location: /?page=profil&id=" . $_SESSION['id']);
                        die;
                    } else {
                        $erreurs['new-password-2'] = "Les mots de passe ne correspondent pas";
                    }
                } else {
                    $erreurs['old-password'] = "Mot de passe incorrect";
                }
            }
        }
    }
} else {
    http_response_code(401);
    $titre = "Erreur 401";
    $page = 401;
}
