<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) {
    require '../src/data/db-connect.php';
    $titre = "Ajout d'un modèle";

    $requete = $connexion->query("SELECT * FROM caracteristique");
    $caracts = $requete->fetchAll();

    $requete = $connexion->query("SELECT * FROM details_caracteristique");
    $details = $requete->fetchAll();

    $requete = $connexion->query("SELECT * FROM etat");
    $etats = $requete->fetchAll();

    $dateAuj = date("Y-m-d");

    if (isset($_POST['validation'])) {

        $erreurs = [];

        $fichiersImages = [
            'image/jpeg',
            'image/jpg',
            'image/png',
            'image/webp',
        ];
        $fichierNotice = 'application/pdf';


        if (empty($_POST['materiel'])) {
            $erreurs['materiel'] = "Le nom est obligatoire";
        }
        if (strlen($_POST['materiel']) > 30) {
            $erreurs['materiel'] = "Le nom est trop long ";
        }
        if (empty($_POST['num-serie'])) {
            $erreurs['num-serie'] = "Un numéro de série est obligatoire";
        }
        if (empty($_POST['nom-caract'])) {
            $erreurs['nom-caract'] = "Caracteristique(s) manquante";
        }
        if (empty($_POST['details-caract'])) {
            $erreurs['details-caract'] = "Détail(s) caracteristique manquant";
        }
        if (empty($_POST['date-achat'])) {
            $erreurs['date-achat'] = "Date d'achat manquante";
        }
        if ($_POST['date-achat'] > $dateAuj) {
            $erreurs['date-achat'] = "Date d'achat erronée";
        }
        if (empty($_POST['etat'])) {
            $erreurs['etat'] = "Etat de l'appareil manquant";
        }

        if (isset($_FILES['image']) && !empty($_FILES['image']['name']) && ($_FILES['image']['error'] == 0)) {
            if (
                !in_array(mime_content_type($_FILES['image']['tmp_name']), $fichiersImages)
                || $_FILES['image']['type'] != mime_content_type($_FILES['image']['tmp_name'])
            ) {
                $erreurs['image'] = "Format non pris en charge";
            }
            if ($_FILES['image']['error'] == 1) {
                $erreurs['image'] = "Le fichier est trop volumineux (> à 2 Mo).";
            }
        } else {
            $erreurs['image'] = "Image manquante ou trop volumineuse";
        }
        if (isset($_FILES['notice']) && !empty($_FILES['notice']['name'])) {
            if (
                mime_content_type($_FILES['notice']['tmp_name']) != $fichierNotice
                || $_FILES['notice']['type'] != mime_content_type($_FILES['notice']['tmp_name'])
            ) {
                $erreurs['notice'] = "Format non pris en charge";
            }
        }
        if ($_FILES['notice']['error'] == 1) {
            $erreurs['notice'] = "Le fichier est trop volumineux (> à 2 Mo).";
        }

        if (empty($erreurs)) {

            $requete = $connexion->prepare("SELECT nom_famille FROM famille WHERE Id_famille=:Id_famille");
            $requete->execute([
                'Id_famille' => $_GET['id']
            ]);
            $nomFamille = $requete->fetch();

            $nomFamilleModif = str_replace(' ', '-', $nomFamille['nom_famille']);
            $nomFamilleModif = strtolower($nomFamilleModif);

            $nomModel = str_replace(' ', '-', $_POST['materiel']);
            $nomModel = strtolower($nomModel);

            $chemin = "assets/img/materiels/" . $nomFamilleModif . "/" . $nomModel . "/";

            $image = $nomModel . '.' . pathinfo($_FILES['image']['name'])['extension'];

            $cheminImage = $chemin . $image;

            mkdir($chemin);

            if (isset($_FILES['notice']) && !empty($_FILES['notice']['name'])) {
                $notice = $nomModel . '.' . pathinfo($_FILES['notice']['name'])['extension'];

                $cheminNotice = $chemin . $notice;

                $requete = $connexion->prepare("INSERT INTO modele (notice_modele) VALUES (:notice_modele)");
                $requete->execute([
                    'notice_modele' => $cheminNotice,
                ]);

                move_uploaded_file($_FILES['notice']['tmp_name'], $cheminNotice);
            }

            $requete = $connexion->prepare("INSERT INTO modele (nom_modele,photo_modele) VALUES (:nom_modele,:photo_modele)");
            $requete->execute([
                'nom_modele' => $_POST['materiel'],
                'photo_modele' => $cheminImage
            ]);

            $idModel = $connexion->lastInsertId();
            move_uploaded_file($_FILES['image']['tmp_name'], $cheminImage);

            $requete = $connexion->prepare("INSERT INTO famille_modele (Id_famille,Id_modele) VALUES (:Id_famille,:Id_modele)");
            $requete->execute([
                'Id_famille' => $_GET['id'],
                'Id_modele' => $idModel
            ]);

            $requete = $connexion->prepare("INSERT INTO modele_caracteristique_details (Id_modele,Id_caracteristique,Id_details_caracteristique) VALUES (:Id_modele,:Id_caracteristique,:Id_details_caracteristique)");
            $requete->execute([
                'Id_modele' => $idModel,
                'Id_caracteristique' => $_POST['nom-caract'],
                'Id_details_caracteristique' => $_POST['details-caract']
            ]);

            $requete = $connexion->prepare("INSERT INTO appareil (numero_serie,date_achat,Id_modele) VALUES (:numero_serie ,:date_achat ,:Id_modele)");
            $requete->execute([
                'numero_serie' => $_POST['num-serie'],
                'date_achat' => $_POST['date-achat'],
                'Id_modele' => $idModel
            ]);
            $idAppareil = $connexion->lastInsertId();

            $requete = $connexion->prepare("INSERT INTO modele_etat (Id_appareil,Id_etat,date_declaration) VALUES (:Id_appareil,:Id_etat,:date_declaration )");
            $requete->execute([
                'Id_appareil' => $idAppareil,
                'Id_etat' => $_POST['etat'],
                'date_declaration' => $dateAuj
            ]);


            header('Location: /?page=categories');
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
