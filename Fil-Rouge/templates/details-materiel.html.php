<?php if (isset($_SESSION['id'])) { ?>

    <h1><?php echo htmlspecialchars($modeles[0]['nom_modele']) ?></h1>

    <img class="img-modele" src="<?php echo htmlspecialchars($modeles[0]['photo_modele']) ?>" alt="">


    <a href="<?php echo $modeles[0]['notice_modele']; ?>" target="_blank">Voir le manuel d'utilisation</a>

    <form action="" method=" post">

        <label>Debut de la location :
            <input type="date" value="" name="loc-debut" min="<?php echo htmlspecialchars($auj) ?>" max="<?php echo htmlspecialchars(date("Y-m-d", $anneProchaine)) ?>" required>
        </label>
        <label>Fin de la location :
            <input type="date" value="" name="loc-fin" min="<?php echo htmlspecialchars($auj) ?>" max="<?php echo htmlspecialchars(date("Y-m-d", $anneProchaine)) ?>" required>
        </label>
        <input type="submit" name="location" value="Louer">
    </form>
    <div>
    <?php
    if (!empty($erreurs)) {
        foreach ($erreurs as $erreur) {
            echo htmlspecialchars($erreur) . '<br>';
        }
    }
}
    ?>
    </div>

    <h2>Description :</h2>

    <ul>
        <?php foreach ($modeles as $modele) { ?>
            <li>
                <td><?php echo htmlspecialchars($modele['detail_caracteristique']) ?></td>
            </li>
        <?php } ?>
    </ul>