<?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
    <h1>Historique des locations</h1>


    <table>
        <thead>
            <tr>
                <th>Id location</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Localisation</th>
                <th>Début location</th>
                <th>Fin location</th>
                <th>Retour location</th>
                <th>Numéro de série</th>
                <th>Modèle</th>
                <th>Etat avant prêt</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($locations as $location) { ?>
                <tr>
                    <td><?php echo isset($location['Id_location']) ? htmlspecialchars($location['Id_location']) : '' ?></td>
                    <td><?php echo isset($location['nom_utilisateur']) ? htmlspecialchars($location['nom_utilisateur']) : '' ?></td>
                    <td><?php echo isset($location['prenom']) ? htmlspecialchars($location['prenom']) : '' ?></td>
                    <td><?php echo isset($location['localisation']) ? htmlspecialchars($location['localisation']) : '' ?></td>
                    <td><?php echo isset($location['date_debut']) ? htmlspecialchars(date('d/m/Y', strtotime($location['date_debut']))) : '' ?></td>
                    <td><?php echo isset($location['date_fin']) ? htmlspecialchars(date('d/m/Y', strtotime(($location['date_fin'])))) : '' ?></td>
                    <td><?php echo isset($location['date_retour']) ? htmlspecialchars(date('d/m/Y', strtotime(($location['date_retour'])))) : '' ?></td>
                    <td><?php echo isset($location['numero_serie']) ? htmlspecialchars($location['numero_serie']) : '' ?></td>
                    <td><?php echo isset($location['nom_modele']) ? htmlspecialchars($location['nom_modele']) : '' ?></td>
                    <td><?php echo isset($location['nom_etat']) ? htmlspecialchars($location['nom_etat']) : '' ?></td>
                </tr>
            <?php } ?>

            <?php if (empty($location)) { ?>
                <tr>
                    <td colspan="9" class="text-center">Aucune location en cours</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php } ?>