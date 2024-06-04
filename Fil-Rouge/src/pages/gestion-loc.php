<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) {

    $titre = "Gestion des Locations";

    require "../src/data/db-connect.php";

    $requete = $connexion->query("SELECT * FROM `location_appareil` JOIN location ON location.Id_location = location_appareil.Id_location JOIN appareil ON appareil.Id_appareil = location_appareil.Id_appareil
JOIN modele ON modele.Id_modele = appareil.Id_modele JOIN utilisateur ON utilisateur.Id_utilisateur = location.Id_utilisateur;");
    $locations = $requete->fetchAll();
} elseif (isset($_SESSION['id']) && $_SESSION['statut'] != 4) {
    http_response_code(403);
    $titre = "Erreur 403";
    $page = 403;
} else {
    http_response_code(401);
    $titre = "Erreur 401";
    $page = 401;
}
