<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) {

    if (!empty($_POST['Id_modele'])) {
        require '../src/data/db-connect.php';

        $requete = $connexion->prepare("SELECT * FROM modele WHERE Id_modele = :Id_modele");
        $requete->execute([
            'Id_modele' => $_POST['Id_modele'],
        ]);
        $nomModele = $requete->fetch();

        $requete = $connexion->prepare("SELECT nom_famille FROM famille_modele JOIN famille ON famille.Id_famille=famille_modele.Id_famille WHERE Id_modele = :Id_modele");
        $requete->execute([
            'Id_modele' => $_POST['Id_modele'],
        ]);
        $nomFamille = $requete->fetch();


        // Foreign KEY en Cascade
        $requete = $connexion->prepare("DELETE FROM modele WHERE Id_modele = :Id_modele");
        $requete->execute([
            'Id_modele' => $_POST['Id_modele'],
        ]);
    }

    if ($nomModele) {
        $nomModifModele = str_replace(' ', '-', $nomModele['nom_modele']);
        $nomModifModele = strtolower($nomModifModele);

        $nomModifFamille = str_replace(' ', '-', $nomFamille['nom_famille']);
        $nomModifFamille = strtolower($nomModifFamille);

        $chemin = "assets/img/materiels/" . $nomModifFamille . "/" . $nomModifModele;

        function supprimerDossier($dossier)
        {
            // Lire le contenu du dossier
            $fichiers =  array_diff(scandir($dossier), array('.', '..'));
            foreach ($fichiers as $fichier) {
                // Si c'est un dossier, on appelle  la fonction
                if (is_dir("$dossier/$fichier")) {
                    supprimerDossier("$dossier/$fichier");
                } else {
                    // Si c'est un fichier, le supprimer
                    unlink("$dossier/$fichier");
                }
            }
            // Supprimer le dossier vide
            return rmdir($dossier);
        }

        if (is_dir($chemin)) {
            (supprimerDossier($chemin));
        }
    }
    header("Location: /?page=categories");
    die;
} elseif (isset($_SESSION['id']) && $_SESSION['statut'] != 4) {
    http_response_code(403);
    $titre = "Erreur 403";
    $page = 403;
} else {
    http_response_code(401);
    $titre = "Erreur 401";
    $page = 401;
}
