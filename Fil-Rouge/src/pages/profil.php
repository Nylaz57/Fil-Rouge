<?php
session_start();
if (isset($_SESSION['id'])) {

    require "../src/data/db-connect.php";

    $titre = "Mon profil";

    $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE Id_utilisateur = :Id_utilisateur");
    $requete->execute([
        'Id_utilisateur' => $_SESSION['id']
    ]);
    $utilisateurInfo = $query->fetch();
}
