<?php
session_start();

if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) {
    $titre = "Gestion des utilisateurs";

    require "../src/data/db-connect.php";

    $requete = $connexion->query("SELECT * FROM utilisateur JOIN statut ON statut.Id_statut = utilisateur.Id_statut ");
    $utilisateurs = $requete->fetchAll();
} elseif (isset($_SESSION['id']) && $_SESSION['statut'] != 4) {
    http_response_code(403);
    $titre = "Erreur 403";
    $page = 403;
} else {
    http_response_code(401);
    $titre = "Erreur 401";
    $page = 401;
}
