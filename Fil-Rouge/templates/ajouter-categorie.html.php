<?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
    <h1>Ajout d'une catégorie</h1>
    <form action="" method="POST">
        <div>
            <label>Nouvelle catégorie :</label>
            <input type="text" name="nom" required>
        </div>
        <div>
            <label>Accès à la catégorie :</label>
            <?php foreach ($statut as $status) {
                if ($status['Id_statut'] != 4) { ?>
                    <div>
                        <input type="checkbox" value="<?php echo htmlspecialchars($status['Id_statut']) ?>" name="statut[]" checked="checked">
                        <label><?php echo htmlspecialchars($status['nom_statut']); ?></label>
                    </div>
            <?php }
            } ?>
        </div>
        <div>
            <input type="submit" name="validation" value="Valider">
            <a href="/?page=categories">Annuler</a>
        </div>
    </form>

<?php
    if (!empty($erreurs)) {
        foreach ($erreurs as $erreur) {
            echo htmlspecialchars($erreur) . '<br>';
        }
    }
}
    // Statuts stockés dans un tableau