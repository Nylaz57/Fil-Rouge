<?php
session_start();
if (isset($_SESSION['id'])) {

    require "../src/data/db-connect.php";

    $requete = $connexion->prepare("SELECT * FROM famille JOIN statut_famille ON statut_famille.Id_famille = famille.Id_famille WHERE Id_statut = :statut");
    $requete->execute([
        'statut' => $_SESSION['statut']
    ]);
    $categories = $requete->fetchAll();

    $titre = "Matériel";
} else {
    http_response_code(401);
    $titre = "Erreur 401";
    $page = 401;
}
