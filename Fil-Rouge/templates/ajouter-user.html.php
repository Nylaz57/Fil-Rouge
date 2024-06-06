<?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
    <h1>Ajout d'un utilisateur</h1>
    <form method="POST">
        <div>
            <label>Statut :</label>
            <select name="statut">
                <option value="1">Stagiaire</option>
                <option value="2">Collaborateur</option>
                <option value="3">Client</option>
                <option value="4">Admin</option>
            </select>
        </div>
        <div>
            <label>Nom :</label>
            <input type="text" name="nom" required>
        </div>
        <div>
            <label>Prénom :</label>
            <input type="text" name="prenom" required>
        </div>
        <div>
            <label>E-mail :</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Mot de passe :</label>
            <input type="password" name="mdp" required>
        </div>
        <div>
            <label>Téléphone :</label>
            <input type="text" name="telephone" size="9" maxlength="10" required>
        </div>
        <div>
            <label>Adresse :</label>
            <input type="text" name="adresse" required>
        </div>
        <div>
            <label>Code postal :</label>
            <input type="text" name="postal" size="4" maxlength="5" required>
        </div>
        <div>
            <label>Ville :</label>
            <input type="text" name="ville" required>
        </div>
        <div>
            <input type="submit" name="valider" value="Valider">
        </div>
    </form>
<?php } ?>