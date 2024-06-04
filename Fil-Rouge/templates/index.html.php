<?php if (!isset($_SESSION['id'])) { ?>
    <div class="index">
        <h1>Bienvenue sur MNS LOC</h1>
        <h2>Connexion</h2>
        <form class="index-form" method="POST">
            <label for="email">E-mail :</label>
            <input type="email" name="email" id="email" required placeholder="ex: john.doe@email.fr">
            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" required>
            <button type="submit" name="bouton-connexion">Se connecter</button>
            <div class="index-error">
                <?php if (!empty($erreurs)) {
                    echo htmlspecialchars("L'adresse mail ou le mot de passe est incorrect");
                } ?>

            </div>

        </form>
        <a href="?page=password">Mot de passe oublié ?</a>
    </div>
<?php }
?>