<?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
    <h1>Ajout d'une actualité</h1>
    <form method="POST" enctype="multipart/form-data">
        <div>
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" maxlength="20" placeholder="20 caractères max" required>
        </div>
        <?php if (!empty($erreurs['titre']))
            echo htmlspecialchars($erreurs['titre']) ?>
        <div>
            <label for="image">Image :</label>
            <input type="file" id="image" name="image" accept=".jpg,.png,.jpeg" size="2000000" required>
        </div>
        <?php if (!empty($erreurs['image']))
            echo htmlspecialchars($erreurs['image']) ?>
        <div>
            <label for="contenu">Contenu :</label>
            <textarea id="contenu" name="contenu" maxlength="255" placeholder="255 caractères max" rows="7" cols="40" required></textarea>
        </div>
        <?php if (!empty($erreurs['contenu']))
            echo htmlspecialchars($erreurs['contenu']) ?>
        <div>
            <input type="submit" name="validation" value="Valider">
        </div>
    </form>
<?php
}

?>