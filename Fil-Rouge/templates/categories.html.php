<?php if (isset($_SESSION['id'])) { ?>
    <h1 class="title">Gestion du materiel</h1>

    <?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
        <a href="?page=ajouter-categorie" title="Ajouter une catégorie" class="addBtn"></a>
    <?php } ?>
    <ul>
        <?php foreach ($categories as $categorie) { ?>
            <li>
                <a href="?page=details-categorie&id=<?php echo htmlspecialchars($categorie['Id_famille']) ?>"><?php echo htmlspecialchars($categorie['nom_famille']) ?></a>
                <?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
                    <a href="/?page=edit-categorie&id=<?php echo htmlspecialchars($categorie['Id_famille']) ?>">Modifier</a>
                    <form action="/?page=delete-categorie" method="POST">
                        <input type="hidden" name="Id_famille" value="<?php echo htmlspecialchars($categorie['Id_famille']) ?>" />
                        <button type="submit">Supprimer</button>
                    <?php } ?>
                    </form>
            </li>
        <?php } ?>
    </ul>
<?php } ?>