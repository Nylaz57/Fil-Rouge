<?php
session_start();
if (isset($_SESSION['id']) && ($_SESSION['statut']) === 4) {

    $titre = "Ajout d'un utilisateur";

    if (isset($_POST['valider'])) {

        $erreurs = [];

        if (empty($_POST['nom'])) {
            $erreurs['nom'] = "Le nom est obligatoire";
        }

        if (empty($_POST['prenom'])) {
            $erreurs['prenom'] = "Le prenom est obligatoire";
        }
        if (empty($_POST['mdp'])) {
            $erreurs['mdp'] = "Le mot de passe est obligatoire ";
        }
        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $erreurs['email'] = "L'email est obligatoire et doit être un format e-mail";
        }

        if (empty($_POST['telephone']) || !is_numeric($_POST['telephone']) || strlen($_POST['telephone']) != 10) {
            $erreurs['telephone'] = "Le numéro de téléphone est obligatoire , il ne doit contenir que des chiffres et doit être composé de 10 chiffes";
        }

        if (empty($_POST['adresse'])) {
            $erreurs['adresse'] = "L'adresse est obligatoire";
        }

        if (empty($_POST['postal']) || !is_numeric($_POST['postal']) || strlen($_POST['postal']) != 5) {
            $erreurs['postal'] = "Le code postal est obligatoire , il ne doit contenir que des chiffres et doit être composé de 5 chiffes";
        }

        if (empty($_POST['ville'])) {
            $erreurs['ville'] = "Le nom de la ville est obligatoire";
        }

        if (empty($erreurs)) {

            $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

            require '../src/data/db-connect.php';
            $requete = $connexion->prepare("INSERT INTO utilisateur (nom_utilisateur, prenom, password, email, telephone, adresse, code_postal, ville, Id_statut) VALUES (:nom_utilisateur, :prenom, :password, :email,:telephone, :adresse, :code_postal, :ville, :Id_statut)");
            $requete->execute([
                'nom_utilisateur' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'password' => $_POST['mdp'],
                'email' => $_POST['email'],
                'telephone' => $_POST['telephone'],
                'adresse' => $_POST['adresse'],
                'code_postal' => $_POST['postal'],
                'ville' => $_POST['ville'],
                'Id_statut' => $_POST['statut']
            ]);

            header('Location: /?page=gestion-users');
            die;
        }
    }
} elseif (isset($_SESSION['id']) && $_SESSION['statut'] != 4) {
    http_response_code(403);
    $titre = "Erreur 403";
    $page = 403;
} else {
    http_response_code(401);
    $titre = "Erreur 401";
    $page = 401;
}
