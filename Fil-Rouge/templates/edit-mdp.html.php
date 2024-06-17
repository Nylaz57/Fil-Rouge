<?php if (isset($_SESSION['id'])) { ?>
    <h1>Changer de mot de passe :</h1>
    <form method="POST">
        <div>
            <label>Votre mot de passe actuel :</label>
            <input type="password" name="old-password" required>
        </div>
        <div>
            <?php if (!empty($erreurs['old-password'])) {
                echo htmlspecialchars($erreurs['old-password']);
            } ?>
        </div>
        <div>
            <label>Nouveau mot de passe :</label>
            <input type="password" name="new-password-1" required>
        </div>
        <div>
            <?php if (!empty($erreurs['new-password-1'])) {
                echo htmlspecialchars($erreurs['new-password-1']);
            } ?>
        </div>
        <div>
            <label>Veuillez ressaisir votre nouveau mot de passe :</label>
            <input type="password" name="new-password-2" required>
        </div>
        <div>
            <?php if (!empty($erreurs['new-password-2'])) {
                echo htmlspecialchars($erreurs['new-password-2']);
            } ?>
        </div>
        <div>
            <input type="submit" name="validation" value="Valider">
            <a href="/?page=profil">Annuler</a>
        </div>
    </form>

<?php
}
