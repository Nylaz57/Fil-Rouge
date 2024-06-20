<?php if (isset($_SESSION['id'])) { ?>
    <h1>Mes locations</h1>

    <table>
        <thead>
            <tr>
                <th></th>
                <th>Nom du modèle</th>
                <th>État</th>
                <th>Numéro de série</th>
                <th>Début de location</th>
                <th>Fin de location</th>
                <th>Date de retour</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($locations as $location) { ?>
                <tr>

                    <td><img class="img-tableau" src="<?php echo $location['photo_modele'] ?>" alt=""></td>
                    <td><?php echo htmlspecialchars($location['nom_modele']) ?></td>
                    <td><?php echo htmlspecialchars($location['nom_etat']) ?></td>
                    <td><?php echo htmlspecialchars($location['numero_serie']) ?></td>
                    <td><?php echo htmlspecialchars($location['date_debut']) ?></td>
                    <td><?php echo htmlspecialchars($location['date_fin']) ?></td>
                    <td><?php isset($location['date_retour']) ? htmlspecialchars($location['date_retour']) : ''  ?></td>
                </tr>

            <?php }
        }
        if (empty($location)) { ?>
            <tr>
                <td colspan=" 9" class="text-center">Aucune location en cours</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>