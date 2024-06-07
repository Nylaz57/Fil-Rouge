<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) {
    require '../src/data/db-connect.php';
    $titre = "Ajout d'une actualité";

    if (isset($_POST['validation'])) {

        $erreurs = [];

        if (empty($_POST['titre'])) {
            $erreurs['titre'] = "Merci de saisir un titre pour la nouvelle actualité";
        }
        if (strlen($_POST['titre']) > 20) {
            $erreurs['titre'] = "Titre trop long ";
        }
        if (empty($_FILES['image']['name'])) {
            $erreurs['image'] = "Image manquante";
        }
        if (empty($_POST['contenu'])) {
            $erreurs['contenu'] = "Contenu manquant";
        }
        if (strlen($_POST['contenu']) > 255) {
            $erreurs['contenu'] = "Contenu trop long";
        }
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $fichiersAutorises = [
                'image/jpeg',
                'image/jpg',
                'image/png',
                'image/webp',
            ];
            if (
                in_array(mime_content_type($_FILES['image']['tmp_name']), $fichiersAutorises)
                && $_FILES['image']['type'] == mime_content_type($_FILES['image']['tmp_name'])
            ) {
                if ($_FILES['image']['size'] < 2000000 && $_FILES['image']['error'] == 0) {

                    $nouveauNom = md5($_FILES['image']['name']) . '.' . pathinfo($_FILES['image']['name'])['extension'];
                    move_uploaded_file($_FILES['image']['tmp_name'], 'assets/img/actualites/' . $nouveauNom);
                } else {
                    $erreurs['image'] = "Le fichier est trop volumineux (> à 2 Mo).";
                }
            } else {
                $erreurs['image'] = "Le fichier doit être une image au format jpg,png ou jpeg.";
            }

            if (empty($erreurs)) {
                date_default_timezone_set('Europe/Paris');
                $requete = $connexion->prepare("INSERT INTO actualites (titre,image,contenu,date_creation,id_utilisateur) VALUES (:titre,:image,:contenu,:date_creation,:id_utilisateur)");
                $requete->execute([
                    'titre' => $_POST['titre'],
                    'image' => $nouveauNom,
                    'contenu' => $_POST['contenu'],
                    'date_creation' => date("Y-m-d H:i:s"),
                    'id_utilisateur' => $_SESSION['id']
                ]);
                header('Location: /?page=accueil');
                die;
            }
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
