<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) {

    require '../src/data/db-connect.php';
    $titre = "Éditer une catégorie";

    $requete = $connexion->prepare("SELECT nom_famille FROM famille WHERE Id_famille=:Id_famille");
    $requete->execute([
        'Id_famille' => $_GET['id']
    ]);
    $categorie = $requete->fetch();

    $requete = $connexion->query("SELECT * FROM statut");
    $statut = $requete->fetchAll();


    $requete = $connexion->prepare("SELECT * FROM statut_famille JOIN statut ON statut.Id_statut = statut_famille.Id_statut WHERE Id_famille=:Id_famille");
    $requete->execute([
        'Id_famille' => $_GET['id']
    ]);
    $statutFamille = $requete->fetchAll();

    if (isset($_POST['validation'])) {
        $erreurs = [];

        if (isset($_POST['statut'])) {
            $statutCoches = $_POST['statut'];
            $statutCoches[] = 4;

            if (empty($_POST['famille'])) {
                $erreurs['famille'] = "Le nom est obligatoire";
            }

            if (empty($erreurs)) {

                $requete = $connexion->prepare("UPDATE famille SET nom_famille = :nom_famille WHERE Id_famille=:Id_famille");
                $requete->execute([
                    'nom_famille' => $_POST['famille'],
                    'Id_famille' => $_GET['id']
                ]);


                $requete = $connexion->prepare("DELETE FROM statut_famille WHERE Id_famille = :Id_famille");
                $requete->execute([

                    'Id_famille' => $_GET['id']
                ]);

                $requete = $connexion->prepare("INSERT INTO statut_famille (Id_statut, Id_famille) VALUES (:Id_statut, :Id_famille)");
                foreach ($statutCoches as $statutCoche) {
                    $requete->execute([
                        'Id_famille' => $_GET['id'],
                        'Id_statut' => $statutCoche
                    ]);
                }

                $nomModif = str_replace(' ', '-', $categorie['nom_famille']);
                $nomModif = strtolower($nomModif);

                $nouveauNom = str_replace(' ', '-', $_POST['famille']);
                $nouveauNom = strtolower($nouveauNom);

                rename("assets/img/materiels/" . $nomModif, "assets/img/materiels/" . $nouveauNom);

                header('Location: /?page=categories');
                die;
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
