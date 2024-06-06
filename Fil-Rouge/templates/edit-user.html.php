<?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
    <h1>Modifier un utilisateur</h1>

    <form method="POST">
        <div>
            <label>Statut :</label>
            <select name="statut">
                <option value="1" <?php if ($utilisateurs['Id_statut'] == 1) {
                                        echo "selected";
                                    } ?>>Stagiaire</option>
                <option value="2" <?php if ($utilisateurs['Id_statut'] == 2) {
                                        echo "selected";
                                    }
                                    ?>>Collaborateur</option>
                <option value="3" <?php if ($utilisateurs['Id_statut'] == 3) {
                                        echo "selected";
                                    } ?>>Client</option>
                <option value="4" <?php if ($utilisateurs['Id_statut'] == 4) {
                                        echo "selected";
                                    } ?>>Admin</option>
            </select>
        </div>
        <div>
            <label>Nom :</label>
            <input type="text" name="nom" value="<?php echo htmlspecialchars($utilisateurs['nom_utilisateur']) ?>" required>
        </div>
        <div>
            <label>Prénom :</label>
            <input type="text" name="prenom" value="<?php echo htmlspecialchars($utilisateurs['prenom']) ?>" required>
        </div>
        <div>
            <label>E-mail :</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($utilisateurs['email']) ?>" required>
        </div>
        <div>
            <label>Téléphone :</label>
            <input type="text" name="telephone" value="<?php echo htmlspecialchars($utilisateurs['telephone']) ?>" size="9" maxlength="10" required>
        </div>
        <div>
            <label>Adresse :</label>
            <input type="text" name="adresse" value="<?php echo htmlspecialchars($utilisateurs['adresse']) ?>" required>
        </div>
        <div>
            <label>Code postal :</label>
            <input type="text" name="postal" size="4" value="<?php echo htmlspecialchars($utilisateurs['code_postal']) ?>" maxlength="5" required>
        </div>
        <div>
            <label>Ville :</label>
            <input type="text" name="ville" value="<?php echo htmlspecialchars($utilisateurs['ville']) ?>" required>
        </div>
        <div>
            <input type="submit" name="valider" value="Valider">
        </div>
    </form>
<?php } ?>