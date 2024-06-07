<?php
session_start();
if (isset($_SESSION['id'])) {


    require "../src/data/db-connect.php";

    $requete = $connexion->prepare("SELECT nom_modele, modele.Id_modele, famille.nom_famille FROM famille_modele JOIN modele ON modele.Id_modele = famille_modele.Id_modele JOIN famille ON famille.Id_famille = famille_modele.Id_famille WHERE famille.Id_famille = :id_famille");
    $requete->execute(["id_famille" => $_GET['id']]);
    $categories = $requete->fetchAll();

    $requete = $connexion->prepare("SELECT * FROM famille WHERE id_famille=:id_famille");
    $requete->execute(["id_famille" => $_GET['id']]);
    $famille = $requete->fetch();

    if (!$famille) {
        http_response_code(404);
        $titre = "Erreur 404";
        require '../templates/404.html.php';
        die;
    }

    $titre = $famille['nom_famille'];
} else {
    http_response_code(401);
    $titre = "Erreur 401";
    $page = 401;
}
