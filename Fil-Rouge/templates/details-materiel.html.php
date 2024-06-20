<?php if (isset($_SESSION['id'])) { ?>

    <div class="sidebar-material">
        <p>hello</p>
    </div>

    <section class="material-container-card toast">

        <div class="material-body">
            <h1><?php echo $modeles[0]['nom_modele'] ?></h1>

            <img class="img-modele" src="<?php echo htmlspecialchars($modeles[0]['photo_modele']) ?>" alt="">
            <form method="post">



                <h3>Je choisis mes dates de location</h3>

                <div class="material-location">
                    <label>Debut de la location :
                        <input type="date" name="loc-debut" min="<?php echo htmlspecialchars($auj) ?>"
                            max="<?php echo htmlspecialchars(date("Y-m-d", $anneProchaine)) ?>" required>
                    </label>
                    <br />
                    <label>Fin de la location :
                        <input type="date" name="loc-fin" min="<?php echo htmlspecialchars($auj) ?>"
                            max="<?php echo htmlspecialchars(date("Y-m-d", $anneProchaine)) ?>" required>
                    </label>
                </div>

                <input type="submit" name="location" value="Louer">

            </form>
        </div>
        <div class="material-description">
            <h3>Description produit</h3>

            <ul>
                <?php foreach ($modeles as $modele) { ?>
                    <li>
                        <td><?php echo $modele['detail_caracteristique'] ?></td>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </section>
<?php } ?>