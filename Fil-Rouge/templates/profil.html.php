<?php if (isset($_SESSION['id'])) { ?>

    <h1>Mon profil</h1>

    </p>Photo de profil : <?php echo isset($utilisateurInfo['photo_utilisateur']) ? htmlspecialchars($utilisateurInfo['photo_utilisateur']) : '' ?></p>

    </p>Nom : <?php echo isset($utilisateurInfo['nom_utilisateur']) ? htmlspecialchars($utilisateurInfo['nom_utilisateur']) : '' ?></p>

    </p>Prenom : <?php echo isset($utilisateurInfo['prenom']) ? htmlspecialchars($utilisateurInfo['prenom']) : '' ?></p>

    </p>Adresse mail : <?php echo isset($utilisateurInfo['email']) ? htmlspecialchars($utilisateurInfo['email']) : '' ?></p>

    <?php if (isset($_SESSION['id']) && $_SESSION['statut'] != 4) { ?>

        </p>Téléphone : <?php echo isset($utilisateurInfo['telephone']) ? htmlspecialchars($utilisateurInfo['telephone']) : '' ?></p>

        </p>Adresse : <?php echo isset($utilisateurInfo['adresse']) ? htmlspecialchars($utilisateurInfo['adresse']) : '' ?></p>

        </p>Code postal : <?php echo isset($utilisateurInfo['code_postal']) ? htmlspecialchars($utilisateurInfo['code_postal']) : '' ?></p>

        </p>Ville : <?php echo isset($utilisateurInfo['ville']) ? htmlspecialchars($utilisateurInfo['ville']) : '' ?></p>
    <?php } ?>
    <a href="?page=edit-mdp">Changer de mot de passe</a>

<?php
}
