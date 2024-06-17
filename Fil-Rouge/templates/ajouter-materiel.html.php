<?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
    <h1>Ajout d'une catégorie</h1>
    <form action="" method="POST">
        <div>
            <label for="materiel">Nom nouveau matériel :</label>
            <input type="text" id="materiel" name="materiel" maxlength="30" placeholder="30 caractères max" required>
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
            <label for="notice">Notice (facultatif) :</label>
            <input type="file" id="notice" name="notice" accept=".pdf" size="2000000">
        </div>
        <?php if (!empty($erreurs['image']))
            echo htmlspecialchars($erreurs['notice']) ?>
        <div>
            <label for="description">Description :</label>
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