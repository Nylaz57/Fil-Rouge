<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MNS LOC - <?= $titre ?? '' ?> </title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script defer src="../assets/js/accueil.js"></script>

</head>

<?php
if (isset($_SESSION['id'])) { ?>
  <header id="header-layout">
    <nav>

      <div class="nav-left">
        <a href="?page=accueil">Accueil</a>
        <a href="?page=categories">Materiel</a>
        <?php if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) { ?>
          <a href="?page=gestion-users">Utilisateurs</a>
          <a href="?page=gestion-loc">Locations</a>
        <?php } ?>
      </div>

      <div class="nav-right">
        <span>
          <?php echo htmlspecialchars($_SESSION['prenom']) . " " . htmlspecialchars($_SESSION['nom_utilisateur']); ?>
        </span>
        <div id="header-nav-inline">
          <a href="?page=profil&id=<?php echo htmlspecialchars($_SESSION['id']) ?> ">Mon profil</a>
          <a href="?page=deconnexion">Deconnexion</a>
        </div>
      </div>
    </nav>
  </header>
  <?php
} ?>



<body>
  <?php require "$page.html.php" ?>


  <!-- <script src="../public/assets/js/main.js"></script> -->
</body>

</html>