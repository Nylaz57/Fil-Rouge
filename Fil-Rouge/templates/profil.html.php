<?php if (isset($_SESSION['id'])) { ?>

    <h1>Mon profil</h1>

    </p>Photo de profil : <?php echo htmlspecialchars($utilisateurInfo['photo_utilisateur']) ?></p>

    </p>Nom : <?php echo htmlspecialchars($utilisateurInfo['nom_utilisateur']) ?></p>

    </p>Prenom : <?php echo htmlspecialchars($utilisateurInfo['prenom']) ?></p>

    </p>Adresse mail : <?php echo htmlspecialchars($utilisateurInfo['email']) ?></p>

    </p>Téléphone : <?php echo htmlspecialchars($utilisateurInfo['telephone']) ?></p>

    </p>Adresse : <?php echo htmlspecialchars($utilisateurInfo['adresse']) ?></p>

    </p>Code postal : <?php echo htmlspecialchars($utilisateurInfo['code_postal']) ?></p>

    </p>Ville : <?php echo htmlspecialchars($utilisateurInfo['ville']) ?></p>

    <a href="?page=edit-mdp">Changer de mot de passe</a>

<?php
}
