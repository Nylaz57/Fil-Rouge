<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) {

    require '../src/data/db-connect.php';
    $titre = "Éditer une actualité";

    $requete = $connexion->prepare("SELECT * FROM actualites WHERE Id_actualites = :id");
    $requete->execute(["id" => $_GET['id']]);
    $actualite = $requete->fetch();


    if (isset($_POST['validation'])) {

        $erreurs = [];
        if (empty($_POST['titre'])) {
            $erreurs['titre'] = "Merci de saisir un titre pour la nouvelle actualité";
        }
        if (strlen($_POST['titre']) > 20) {
            $erreurs['titre'] = "Titre trop long ";
        }
        if (empty($_FILES['image']['name']) && empty($_POST['image_actuelle'])) {
            $erreurs['image'] = "Image manquante";
        }
        if (empty($_POST['contenu'])) {
            $erreurs['contenu'] = "Contenu manquant";
        }
        if (strlen($_POST['contenu']) > 255) {
            $erreurs['contenu'] = "Contenu trop long";
        }
        if (empty($erreurs)) {
            if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
                $fichiersAutorises = [
                    'image/jpeg',
                    'image/jpg',
                    'image/png',
                ];
                if (
                    in_array(mime_content_type($_FILES['image']['tmp_name']), $fichiersAutorises)
                    && $_FILES['image']['type'] == mime_content_type($_FILES['image']['tmp_name'])
                ) {
                    if ($_FILES['image']['size'] < 2000000 && $_FILES['image']['error'] == 0) {

                        $nouveauNom = md5($_FILES['image']['name']) . '.' . pathinfo($_FILES['image']['name'])['extension'];
                        move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $nouveauNom);
                    } else {
                        $erreurs['image'] = "Le fichier est trop volumineux (> à 2 Mo).";
                    }
                } else {
                    $erreurs['image'] = "Le fichier doit être une image au format jpg,png ou jpeg.";
                }
                if (empty($erreurs)) {

                    unlink('img/' . $actualite['image']);

                    $requete = $connexion->prepare("UPDATE actualites SET titre = :titre , image = :image, contenu =:contenu WHERE Id_actualites=:Id_actualites");
                    $requete->execute([
                        'titre' => $_POST['titre'],
                        'image' => $nouveauNom,
                        'contenu' => $_POST['contenu'],
                        'Id_actualites' => $_GET['id']
                    ]);
                    header('Location: /?page=accueil');
                    die;
                }
            } else {
                $requete = $connexion->prepare("UPDATE actualites SET titre = :titre , contenu =:contenu WHERE Id_actualites=:Id_actualites");
                $requete->execute([
                    'titre' => $_POST['titre'],
                    'contenu' => $_POST['contenu'],
                    'Id_actualites' => $_GET['id']
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
