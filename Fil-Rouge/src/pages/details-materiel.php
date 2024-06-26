<?php
session_start();
if (isset($_SESSION['id'])) {

    require "../src/data/db-connect.php";

    $requete = $connexion->prepare("SELECT * FROM modele_caracteristique_details JOIN modele ON modele.Id_modele = modele_caracteristique_details.Id_modele JOIN caracteristique ON caracteristique.Id_caracteristique = modele_caracteristique_details.Id_caracteristique JOIN details_caracteristique ON details_caracteristique.Id_details_caracteristique = modele_caracteristique_details.Id_details_caracteristique WHERE modele.Id_modele= :modele  
ORDER BY `caracteristique`.`nom_caracteristique` ASC");
    $requete->execute(["modele" => $_GET['id']]);
    $modeles = $requete->fetchAll();

    $requete = $connexion->prepare("SELECT numero_serie , nom_etat , appareil.Id_appareil , location_appareil.date_retour FROM appareil LEFT JOIN location_appareil ON location_appareil.Id_appareil = appareil.Id_appareil JOIN modele_etat ON modele_etat.Id_appareil = appareil.Id_appareil JOIN etat ON etat.id_etat = modele_etat.Id_etat WHERE Id_modele=:modele ORDER BY `appareil`.`numero_serie` ASC");
    $requete->execute(["modele" => $_GET['id']]);
    $appareils = $requete->fetchAll();

    $titre = $modeles[0]['nom_modele'];
    // Date d'aujourd'hui format américain 
    $auj = date("Y-m-d");
    // On transforme la date en timestamp pour le calcul de dates
    $aujLoc = strtotime(date("Y-m-d"));
    // Corresponds en timestamp à l'heure , minute , seconde , mois , jour , année + 1
    $anneProchaine  = mktime(0, 0, 0, date("m"), date("d"), date("Y") + 1);

    if (isset($_POST['location'])) {
        $erreurs = [];

        $debutLoc = strtotime($_POST['loc-debut']);
        $finLoc = strtotime($_POST['loc-fin']);

        // On retourne un tableau associatif avec differentes informations des dates debut et date fin
        $jourDebutLoc = getdate($debutLoc);
        $jourFinLoc = getdate($finLoc);


        if ($jourDebutLoc['weekday'] == 'Saturday' || $jourDebutLoc['weekday'] == 'Sunday') {
            $erreurs['loc-debut'] = "Fermé le samedi et le dimanche , merci de choisir une autre date de début de location";
        }

        if ($jourFinLoc['weekday'] == 'Saturday' || $jourFinLoc['weekday'] == 'Sunday') {
            $erreurs['loc-fin'] = "Fermé le samedi et le dimanche , merci de choisir une autre date de fin de location";
        }

        if (empty($debutLoc)) {
            $erreurs['loc-debut'] = "Pas de date de debut de location";
        }
        if (empty($finLoc)) {
            $erreurs['loc-fin'] = "Pas de date de fin de location";
        }
        if ($debutLoc < $aujLoc) {
            $erreurs['loc-debut'] = "Date de debut non valide";
        }
        if ($finLoc > $anneProchaine || $finLoc <= $debutLoc) {
            $erreurs['loc-fin'] = "Date de fin non valide";
        }

        if (empty($erreurs)) {

            $requete = $connexion->prepare("SELECT * 
FROM location_appareil 
JOIN location ON location.Id_location = location_appareil.Id_location 
RIGHT JOIN appareil ON appareil.Id_appareil = location_appareil.Id_appareil 
WHERE Id_modele = :Id_modele
AND (
    (date_debut NOT BETWEEN :debutLoc AND  :finLoc 
    AND date_fin NOT BETWEEN :debutLoc AND :finLoc) 
    OR date_debut IS NULL
)");
            $requete->execute([
                "Id_modele" => $_GET['id'],
                "debutLoc" => $debutLoc,
                "finLoc" => $finLoc
            ]);
            $modelesLoc = $requete->fetch();

            if ($modelesLoc) {
                $requete = $connexion->prepare("INSERT INTO location (localisation, date_debut, date_fin, Id_utilisateur) VALUES (:localisation,:date_debut,:date_fin,:Id_utilisateur)");
                $requete->execute([
                    "localisation" => $_SESSION['adresse'] . " " . $_SESSION['code_postal'] . " " . $_SESSION['ville'],
                    "date_debut" => date('Y-m-d', $debutLoc),
                    "date_fin" => date('Y-m-d', $finLoc),
                    "Id_utilisateur" => $_SESSION['id']
                ]);
                $idLocation = $connexion->lastInsertId();

                $requete = $connexion->prepare("INSERT INTO location_appareil (Id_location, Id_appareil) VALUES (:Id_location,:Id_appareil)");
                $requete->execute([
                    "Id_location" => $idLocation,
                    "Id_appareil" => $modelesLoc['Id_appareil']
                ]);
                header('Location: /?page=accueil');
                die;
            } else {
                $erreurs['Location'] = "Aucun appareil disponible pour ces dates";
            }
        }
    }
} else {
    http_response_code(401);
    $titre = "Erreur 401";
    $page = 401;
}
