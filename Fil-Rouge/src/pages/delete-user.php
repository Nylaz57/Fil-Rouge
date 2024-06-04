<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) {

    if (!empty($_POST['Id_utilisateur'])) {
        require '../src/data/db-connect.php';

        $requete = $connexion->prepare("DELETE FROM utilisateur WHERE Id_utilisateur = :Id_utilisateur");
        $requete->execute([
            'Id_utilisateur' => $_POST['Id_utilisateur'],
        ]);
    }

    header("Location: /?page=gestion-users");
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
