<?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
    <h1>Gestion des utilisateurs</h1>

    <a href="/?page=ajouter-user">Ajouter un utilisateur</a>

    <table>
        <thead>
            <tr>
                <th>Id utilisateur</th>
                <th>Statut</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Code Postal</th>
                <th>Ville</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur) { ?>
                <tr>
                    <td><?php echo isset($utilisateur['Id_utilisateur']) ? htmlspecialchars($utilisateur['Id_utilisateur']) : '' ?></td>
                    <td><?php echo isset($utilisateur['nom_statut']) ? htmlspecialchars($utilisateur['nom_statut']) : '' ?></td>
                    <td><?php echo isset($utilisateur['nom_utilisateur']) ? htmlspecialchars($utilisateur['nom_utilisateur']) : '' ?></td>
                    <td><?php echo isset($utilisateur['prenom']) ? htmlspecialchars($utilisateur['prenom']) : '' ?></td>
                    <td><?php echo isset($utilisateur['email']) ? htmlspecialchars($utilisateur['email']) : '' ?></td>
                    <td><?php echo isset($utilisateur['telephone']) ? htmlspecialchars($utilisateur['telephone']) : '' ?></td>
                    <td><?php echo isset($utilisateur['adresse']) ? htmlspecialchars($utilisateur['adresse']) : '' ?></td>
                    <td><?php echo isset($utilisateur['code_postal']) ? htmlspecialchars($utilisateur['code_postal']) : '' ?></td>
                    <td><?php echo isset($utilisateur['ville']) ? htmlspecialchars($utilisateur['ville']) : '' ?></td>
                    <td>
                        <a href="/?page=edit-user&id=<?php echo htmlspecialchars($utilisateur['Id_utilisateur']) ?>">Modifier</a>
                    </td>
                    <td>
                        <form action="/?page=delete-user" method="POST">
                            <input type="hidden" name="Id_utilisateur" value="<?php echo htmlspecialchars($utilisateur['Id_utilisateur']) ?>" />
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>

            <?php if (empty($utilisateur)) { ?>
                <tr>
                    <td colspan="9" class="text-center">Aucun utilisateur présent dans la base de données</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php } ?>