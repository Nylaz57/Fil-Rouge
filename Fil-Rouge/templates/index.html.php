<?php if (!isset($_SESSION['id'])) { ?>
    <div class="container-connexion">
        <div class="container-connexion-box">

            <h1>mns.<span>loc</span></h1>
            <div class="index">

                <h2>Connexion</h2>

                <form class="index-form" method="POST">

                    <label for="email">Adresse e-mail :</label>
                    <input type="email" name="email" id="email" required placeholder="ex: john.doe@email.fr">

                    <label for="mdp">Mot de passe :</label>
                    <div class="icon-container">
                        <input type="password" name="mdp" id="mdp" required>
                        <span class="icon-mdp"></span>
                    </div>

                    <div class="index-error">
                        <p id="index-error-message"></p>
                        <?php if (!empty($erreurs)) {
                            echo htmlspecialchars("L'adresse mail ou le mot de passe est incorrect");
                        } ?>
                    </div>

                    <hr class="hr-connexion">
                    <button type="submit" name="bouton-connexion" id="bouton-connexion">Se connecter</button>


                </form>

                <a href="?page=password">Mot de passe oublié ?</a>
            </div>
        </div>
    </div>
<?php }
?>