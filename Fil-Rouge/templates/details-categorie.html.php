<?php if (isset($_SESSION['id'])) { ?>
    <h1><?php echo htmlspecialchars($famille['nom_famille']) ?></h1>
    <?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
        <a href="?page=ajouter-modele&id=<?php echo htmlspecialchars($famille['Id_famille']) ?>"> Ajouter un modèle </a>
    <?php } ?>
    <ul>
        <?php foreach ($categories as $categorie) { ?>
            <li>
                <a href="?page=details-modele&id=<?php echo htmlspecialchars($categorie['Id_modele']) ?>"><?php echo htmlspecialchars($categorie['nom_modele']) ?></a>
                <?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
                    <a href="/?page=edit-modele&id=<?php echo htmlspecialchars($categorie['Id_modele']) ?>">Modifier</a>
                    <form action="/?page=delete-modele" method="POST">
                        <input type="hidden" name="Id_modele" value="<?php echo htmlspecialchars($categorie['Id_modele']) ?>" />
                        <button type="submit">Supprimer</button>
                    <?php } ?>
                    </form>
            </li>

        <?php } ?>
    </ul>
<?php } ?>