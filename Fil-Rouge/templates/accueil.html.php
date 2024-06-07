<?php if (isset($_SESSION['id'])) { ?>
    <h1>Actualités</h1>
    <?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
        <a href="?page=ajouter-actualite">Nouvelle actualité</a>
    <?php }

    foreach ($actualites as $actualite) { ?>
        <h2><?php echo htmlspecialchars($actualite['titre']) ?></h2>

        <p><?php echo htmlspecialchars($actualite['contenu']) ?></p>

        <img class="img-actualite" src="assets/img/actualites/<?php echo htmlspecialchars($actualite['image']) ?>" alt="">

        <p>Publié par <?php echo htmlspecialchars($actualite['nom_utilisateur']) . " " . htmlspecialchars($actualite['prenom']) ?>
            , le <?php echo htmlspecialchars(date('d/m/Y - H:i:s', strtotime($actualite['date_creation']))) ?></p>

        <?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
            <form action=" /?page=delete-actualite" method="POST">
                <a href="/?page=edit-actualite&id=<?php echo htmlspecialchars($actualite['Id_actualites']) ?>">Modifier</a>
                <input type="hidden" name="Id_actualites" value="<?php echo htmlspecialchars($actualite['Id_actualites']) ?>" />
                <button type="submit">Supprimer</button>
            </form>
<?php }
    }

    if (!empty($erreurs)) {
        foreach ($erreurs as $erreur) {
            echo htmlspecialchars($erreur) . '<br>';
        }
    }
}
