<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) {

    require '../src/data/db-connect.php';
    $titre = "Éditer une catégorie";

    $requete = $connexion->prepare("SELECT nom_famille FROM famille WHERE Id_famille=:Id_famille");
    $requete->execute([
        'Id_famille' => $_GET['id']
    ]);
    $categorie = $requete->fetch();

    $requete = $connexion->query("SELECT * FROM statut");
    $statut = $requete->fetchAll();


    $requete = $connexion->prepare("SELECT * FROM statut_famille JOIN statut ON statut.Id_statut = statut_famille.Id_statut WHERE Id_famille=:Id_famille");
    $requete->execute([
        'Id_famille' => $_GET['id']
    ]);
    $statutFamille = $requete->fetchAll();

    if (isset($_POST['validation'])) {

        $erreurs = [];

        if (empty($_POST['famille'])) {
            $erreurs['famille'] = "Le nom est obligatoire";
        }

        if (empty($erreurs)) {

            $requete = $connexion->prepare("UPDATE famille SET nom_famille = :nom_famille WHERE Id_famille=:Id_famille");
            $requete->execute([
                'nom_famille' => $_POST['famille'],
                'Id_famille' => $_GET['id']
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
