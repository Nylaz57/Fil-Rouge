<?php if (!isset($_SESSION['id'])) {
    $titre = "Connexion";
    if (isset($_POST['bouton-connexion'])) {

        $erreurs = [];

        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $erreurs['email'] = "Erreur adresse mail vide";
        }

        if (empty($_POST['mdp'])) {
            $erreurs['mdp'] = "Erreur mot de passe vide";
        }

        if (empty($erreurs)) {
            require "../src/data/db-connect.php";
            $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE email = :email");
            $requete->execute(['email' => $_POST['email']]);
            $ligne = $requete->fetch();

            if ($ligne) {

                if (password_verify($_POST['mdp'], $ligne['password'])) {

                    session_start();
                    $_SESSION['id'] = $ligne['Id_utilisateur'];
                    $_SESSION['prenom'] = $ligne["prenom"];
                    $_SESSION['nom_utilisateur'] = $ligne["nom_utilisateur"];
                    $_SESSION['statut'] = $ligne["Id_statut"];
                    header('Location: /?page=accueil');
                    exit;
                } else {
                    $erreurs['mdp'] = "Erreur mot de passe incorrecte";
                }
            } else {
                $erreurs['email'] = "Erreur adresse mail invalide";
            }
        }
    }
} else {
    header("Location: ../templates/accueil.html.php");
}
