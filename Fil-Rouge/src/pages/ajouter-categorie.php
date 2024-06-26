<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) {
    require '../src/data/db-connect.php';
    $titre = "Ajout d'une catégorie";
    $requete = $connexion->query("SELECT * FROM statut ");
    $statut = $requete->fetchAll();

    if (isset($_POST['validation'])) {
        $erreurs = [];
        if (isset($_POST['statut'])) {
            $statutCoches = $_POST['statut'];
            //le status admin est ajouté car il n'est pas present dans les checkbox
            $statutCoches[] = 4;

            if (!empty($_POST['nom'])) {

                $requete = $connexion->prepare("SELECT * FROM famille WHERE nom_famille = :nom_famille");
                $requete->execute([
                    'nom_famille' => $_POST['nom']
                ]);
                $nomFamille = $requete->fetch();

                if (!$nomFamille) {
                    $requete = $connexion->prepare("INSERT INTO famille (nom_famille) VALUES (:nom_famille)");
                    $requete->execute([
                        'nom_famille' => $_POST['nom']
                    ]);
                    $id_famille = $connexion->lastInsertId();

                    $requete = $connexion->prepare("INSERT INTO statut_famille (Id_statut, Id_famille) VALUES (:Id_statut, :Id_famille)");
                    foreach ($statutCoches as $statutCoche) {
                        $requete->execute([
                            'Id_famille' => $id_famille,
                            'Id_statut' => $statutCoche
                        ]);
                    }
                    header('Location: /?page=categories');
                    die;
                } else {
                    $erreurs['nom'] = "Une catégorie existe déjà avec ce nom";
                }
            } else {
                $erreurs['nom'] = "Merci de saisir un nom pour la nouvelle catégorie";
            }
        } else {
            $erreurs['statut'] = "Statut manquant !";
        }
    }
} elseif (isset($_SESSION['id']) && $_SESSION['statut'] != 4) {
    http_response_code(403);
    $titre = "Erreur 403";
    $page = 403;
} else {
    http_response_code(401);
    $titre = "Erreur 401";
    $page = 401;
}
