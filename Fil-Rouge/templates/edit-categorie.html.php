<?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
    <h1>Éditer une catégorie de matériel</h1>
    <form method="POST">
        <div>
            <label for="famille">Nom de la catégorie :</label>
            <input type="text" name="famille" value="<?php echo htmlspecialchars($categorie['nom_famille']) ?>" required>
        </div>
        <?php if (!empty($erreurs['famille']))
            echo htmlspecialchars($erreurs['famille']) ?>
        <div>
            <div>
                <label>Accès à la catégorie :</label>
                <?php foreach ($statut as $status) {
                    if ($status['Id_statut'] != 4) { ?>
                        <div>
                            <input type="checkbox" value="<?php echo htmlspecialchars($status['Id_statut']) ?>" name="<?php echo htmlspecialchars($status['nom_statut']) ?>" checked="checked">
                            <label><?php echo htmlspecialchars($status['nom_statut']) ?></label>

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
    var_dump($categorie);
    var_dump($statut);
    var_dump($statutFamille);
}
