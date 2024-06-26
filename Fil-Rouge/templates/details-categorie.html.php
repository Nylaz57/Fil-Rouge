<?php if (isset($_SESSION['id'])) { ?>

    <h1><?php echo htmlspecialchars($categories[0]['nom_famille']) ?></h1>
    <ul>
        <?php foreach ($categories as $categorie) { ?>
            <li>
                <a class="categorieList" href="?page=details-materiel&id=<?php echo htmlspecialchars($categorie['Id_modele']) ?>"><?php echo htmlspecialchars($categorie['nom_modele']) ?></a>
            </li>

        <?php } ?>
    </ul>
    
<?php } ?>