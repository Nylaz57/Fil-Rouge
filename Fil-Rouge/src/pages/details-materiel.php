<?php
session_start();
if (isset($_SESSION['id'])) {

    require "../src/data/db-connect.php";

    $requete = $connexion->prepare("SELECT modele.Id_modele, nom_modele, detail_caracteristique , notice_modele , photo_modele FROM modele_caracteristique JOIN modele ON modele.Id_modele = modele_caracteristique.Id_modele JOIN caracteristique ON caracteristique.Id_caracteristique=modele_caracteristique.Id_caracteristique WHERE modele.Id_modele= :modele ORDER BY `caracteristique`.`detail_caracteristique` ASC");
    $requete->execute(["modele" => $_GET['id']]);
    $modeles = $requete->fetchAll();

    $requete = $connexion->prepare("SELECT numero_serie , nom_etat , appareil.Id_appareil , location_appareil.date_retour FROM appareil LEFT JOIN location_appareil ON location_appareil.Id_appareil = appareil.Id_appareil JOIN modele_etat ON modele_etat.Id_appareil = appareil.Id_appareil JOIN etat ON etat.id_etat = modele_etat.Id_etat WHERE Id_modele=:modele ORDER BY `appareil`.`numero_serie` ASC");
    $requete->execute(["modele" => $_GET['id']]);
    $appareils = $requete->fetchAll();

    $titre = $modeles[0]['nom_modele'];
    // Date d'aujourd'hui format américain 
    $auj = date("Y-m-d");
    // 0,0,0 corresponds à l'heure , minute , seconde
    $anneProchaine  = mktime(0, 0, 0, date("m"),   date("d"),   date("Y") + 1);
} else {
    http_response_code(401);
    $titre = "Erreur 401";
    $page = 401;
}
