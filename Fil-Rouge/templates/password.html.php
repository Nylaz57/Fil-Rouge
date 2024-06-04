<?php if (!isset($_SESSION['id'])) { ?>
    <h1>Mot de passe oublié</h1>

    <p>Veuillez saisir votre adresse mail ci-dessous :</p>

    <form method="post">
        <input type="email" name="email-mdp" id="email-mdp" required placeholder="ex: john.doe@email.fr">
        <button type="submit" name="bouton-mdp">Envoyer</button>
        <div>
            <?php if (!empty($errors)) {
                echo htmlspecialchars($errors['email-mdp']);
            } ?>
        </div>
        <a href="?page=index">Retour à l'accueil</a>
    </form>
<?php } ?>