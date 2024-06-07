<?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
    <h1>Éditer une actualité</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" maxlength="20" placeholder="20 caractères max" value="<?php echo htmlspecialchars($actualite['titre']) ?>" required>
        </div>
        <?php if (!empty($erreurs['titre']))
            echo htmlspecialchars($erreurs['titre']) ?>
        <div>
            <label for="image">Remplacer l'image :</label>
            <input type="file" id="image" name="image" accept=".jpg,.png,.jpeg,.webp" size="2000000">
            <input type="hidden" name="image_actuelle" value="<?php echo htmlspecialchars($actualite['image']); ?>">
        </div>
        <?php if (!empty($erreurs['image']))
            echo htmlspecialchars($erreurs['image']) ?>
        <div>
            <label for=" contenu">Contenu :</label>
            <textarea id="contenu" name="contenu" maxlength="255" rows="7" cols="40" required><?php echo htmlspecialchars($actualite['contenu']) ?></textarea>
        </div>
        <?php if (!empty($erreurs['contenu']))
            echo htmlspecialchars($erreurs['contenu']) ?>
        <div>
            <input type="submit" name="validation" value="Valider">
            <a href="/?page=accueil">Annuler</a>
        </div>
    </form>
<?php
}
