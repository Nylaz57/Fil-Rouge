<?php
session_start();
if (isset($_SESSION['id'])) {
    require '../src/data/db-connect.php';
    $titre = "Mes locations";

    $requete = $connexion->prepare("SELECT * FROM `location` JOIN location_appareil ON location_appareil.Id_location = location.Id_location JOIN appareil ON appareil.Id_appareil = location_appareil.Id_appareil JOIN modele ON modele.Id_modele = appareil.Id_modele JOIN modele_etat ON modele_etat.Id_appareil = appareil.Id_appareil JOIN etat ON etat.Id_etat = modele_etat.Id_etat WHERE Id_utilisateur = :Id_utilisateur");
    $requete->execute(['Id_utilisateur' => $_SESSION['id']]);
    $locations = $requete->fetchAll();
}
