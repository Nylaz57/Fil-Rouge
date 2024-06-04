<?php
session_start();

if (isset($_SESSION['id'])) {
    $erreurs = [];
    require "../src/data/db-connect.php";

    $requete = $connexion->query("SELECT * FROM actualites JOIN utilisateur ON actualites.Id_utilisateur = utilisateur.Id_utilisateur");

    $actualites = $requete->fetchAll();

    if (!$actualites) {
        $erreurs = "Il n'y a aucune actualités !";
    }

    $titre = "Accueil";

    
} else {
    http_response_code(401);
    $titre = "Erreur 401";
    $page = 401;
}
