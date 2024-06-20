<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MNS LOC - <?= $titre ?? '' ?> </title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<header>
  <?php
  if (isset($_SESSION['id'])) { ?>
    <nav>
      <a href="?page=accueil">Accueil</a>
      <a href="?page=categories">Materiel</a>
      <?php
      if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
        <a href="?page=gestion-users">Utilisateurs</a>
        <a href="?page=gestion-loc">Locations</a>
      <?php }
      if (isset($_SESSION['id']) && $_SESSION['statut'] != 4) { ?>
        <a href="?page=locations">Mes locations</a>
      <?php } ?>
      <?php echo htmlspecialchars($_SESSION['prenom']) . " " . htmlspecialchars($_SESSION['nom_utilisateur']); ?>
      <a href="?page=profil&id=<?php echo htmlspecialchars($_SESSION['id']) ?> ">Mon profil</a>
      <a href="?page=deconnexion">Déconnexion</a>
    </nav>
  <?php
  } ?>
</header>


<body>
  <?php require "$page.html.php" ?>

</body>

</html>