<?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
    <h1>Ajout d'un modèle</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <label for="materiel">Nom nouveau modèle :</label>
            <input type="text" id="materiel" name="materiel" maxlength="30" placeholder="30 caractères max" required>
        </div>
        <?php if (!empty($erreurs['materiel']))
            echo htmlspecialchars($erreurs['titre']) ?>
        <div>
            <label for="image">Image :</label>
            <input type="file" id="image" name="image" accept=".jpg,.png,.jpeg,.webp" size="2000000" required>

        </div>
        <?php if (!empty($erreurs['image']))
            echo htmlspecialchars($erreurs['image']) ?>
        <div>
            <label for="notice">Notice (facultatif) :</label>
            <input type="file" id="notice" name="notice" accept=".pdf" size="2000000">
        </div>
        <?php if (!empty($erreurs['notice']))
            echo htmlspecialchars($erreurs['notice']) ?>
        <div>
            <label for="description">Description :</label>
            <select required name="nom-caract">
                <option value="">--Sélectionnez une caractéristique--</option>
                <?php foreach ($caracts as $caract) { ?>
                    <option value="<?php echo htmlspecialchars($caract["Id_caracteristique"]) ?>"> <?php echo htmlspecialchars($caract["nom_caracteristique"]) ?></option>
                <?php } ?>
            </select>
            <?php if (!empty($erreurs['nom-caract']))
                echo htmlspecialchars($erreurs['nom-caract']) ?>
            <select required name="details-caract">
                <option value="">--Sélectionnez un détail / quantité--</option>
                <?php foreach ($details as $detail) { ?>
                    <option value="<?php echo htmlspecialchars($detail["Id_details_caracteristique"]) ?>"> <?php echo htmlspecialchars($detail["details_caracteristique"]) ?></option>
                <?php } ?>
            </select>
            <?php if (!empty($erreurs['nom-caract']))
                echo htmlspecialchars($erreurs['nom-caract']) ?>
            <button onclick="// Manque le JS">+</button>
        </div>
        <h3>Appareils :</h3>
        <div>
            <label for="num-serie">Numéro de série :</label>
            <input type="text" id="num-serie" name="num-serie" required>
            <?php if (!empty($erreurs['num-serie']))
                echo htmlspecialchars($erreurs['num-serie']) ?>
            <label for="date-achat">Date d'achat :</label>
            <input type="date" value="" id="date-achat" name="date-achat" max="<?php echo htmlspecialchars(date($dateAuj)) ?>" required>
            <?php if (!empty($erreurs['date-achat']))
                echo htmlspecialchars($erreurs['date-achat']) ?>
            <select required name="etat">
                <option value="">--Sélectionnez l'état du produit--</option>
                <?php foreach ($etats as $etat) { ?>
                    <option value="<?php echo htmlspecialchars($etat["Id_etat"]) ?>"> <?php echo htmlspecialchars($etat["nom_etat"]) ?></option>
                <?php } ?>
            </select>
            <?php if (!empty($erreurs['etat']))
                echo htmlspecialchars($erreurs['etat']) ?>
            <button onclick="// Manque le JS">+</button>
        </div>
        <div>
            <input type="submit" name="validation" value="Valider">
            <a href="/?page=categories">Annuler</a>
        </div>
    </form>

<?php
}
