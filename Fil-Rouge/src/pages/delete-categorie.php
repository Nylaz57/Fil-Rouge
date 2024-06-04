<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) {

    if (!empty($_POST['Id_famille'])) {
        require '../src/data/db-connect.php';

        // Foreign KEY en Cascade
        $requete = $connexion->prepare("DELETE FROM famille WHERE Id_famille = :Id_famille");
        $requete->execute([
            'Id_famille' => $_POST['Id_famille'],
        ]);
    }

    header("Location: /?page=categories");
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
