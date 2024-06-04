<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) {

    if (!empty($_POST['Id_actualites'])) {
        require '../src/data/db-connect.php';

        $requete = $connexion->prepare("DELETE FROM actualites WHERE Id_actualites = :Id_actualites");
        $requete->execute([
            'Id_actualites' => $_POST['Id_actualites'],
        ]);
    }

    header("Location: /?page=accueil");
    die;
} elseif (isset($_SESSION['id']) && $_SESSION['statut'] != 4) {
    http_response_code(403);
    $titre = "Erreur 403";
    $page = 403;
} else {
    http_response_code(401);
    $titre = "Erreur 401";
    $page = 401;
}
