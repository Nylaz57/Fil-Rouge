<?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
    <h1>Éditer une catégorie de matériel</h1>
    <form action="" method="POST">
        <div>
            <label for="famille">Nom de la catégorie :</label>
            <input type="text" name="famille" value="<?php echo htmlspecialchars($categorie['nom_famille'] ?? '') ?>" required>
        </div>
        <?php if (!empty($erreurs['famille'])) : ?>
            <div><?php echo htmlspecialchars($erreurs['famille']) ?></div>
        <?php endif; ?>
        <div>
            <div>
                <label>Accès à la catégorie :</label>
                <?php foreach ($statut as $status) {
                    if ($status['Id_statut'] != 4) {
                        $valide = false;
                        foreach ($statutFamille as $statutFamilles) {
                            if ($statutFamilles['nom_statut'] === $status['nom_statut']) {
                                $valide = true;
                            }
                        }
                ?>
                        <input type="checkbox" value="<?php echo htmlspecialchars($status['Id_statut']) ?>" name="statut[]" <?php if ($valide) { ?>checked<?php } ?>>
                        <label><?php echo htmlspecialchars($status['nom_statut']) ?></label>
                <?php }
                } ?>
            </div>
            <div>
                <input type="submit" name="validation" value="Valider">
                <a href="/?page=categories">Annuler</a>
            </div>
        </div>
    </form>

<?php
    if (!empty($erreurs)) {
        foreach ($erreurs as $erreur) {
            echo htmlspecialchars($erreur) . '<br>';
        }
    }
}
