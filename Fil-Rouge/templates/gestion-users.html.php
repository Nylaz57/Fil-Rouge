<?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
    <section class="gestion-user">
        <h1 class="title">Gestion des utilisateurs</h1>


        <table id="myTable" class="display">
                    <a href="/?page=ajouter-user" title="Ajouter un utilisateur" class="addBtn"></a>

            <thead>
                <tr>
                    <th>Id</th>
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
                        <td><?php echo htmlspecialchars($utilisateur['Id_utilisateur']) ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['nom_statut']) ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['nom_utilisateur']) ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['prenom']) ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['email']) ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['telephone']) ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['adresse']) ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['code_postal']) ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['ville']) ?></td>
                        <td>
                            <a href="/?page=edit-user&id=<?php echo htmlspecialchars($utilisateur['Id_utilisateur']) ?>" title="Modifier" class="addBtn"></a>
                        </td>
                        <td>
                            <form action="/?page=delete-user" method="POST">
                                <input type="hidden" name="Id_utilisateur"
                                    value="<?php echo htmlspecialchars($utilisateur['Id_utilisateur']) ?>" />
                                <button type="submit" class="addBtn" title="Supprimer"></button>
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
    </section>
<?php } ?>