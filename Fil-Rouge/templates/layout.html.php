<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MNS LOC - <?= $titre ?? '' ?> </title>
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- DATATABLES IMPORT -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
  <script defer src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <!-- JQUERY IMPORT -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <script defer src="../assets/js/accueil.js"></script>
  <script defer src="../assets/js/main.js"></script>

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
        <a
          href="?page=profil&id=<?php echo htmlspecialchars($_SESSION['id']) ?> "><?php echo htmlspecialchars($_SESSION['prenom']) . " " . htmlspecialchars($_SESSION['nom_utilisateur']); ?></a>
        <a href="?page=profil&id=<?php echo htmlspecialchars($_SESSION['id']) ?> ">Mon profil</a>
        <a href="?page=deconnexion">Deconnexion</a>
      </div>

    </nav>
  </header>
  <?php
} ?>



<body>
  <?php require "$page.html.php" ?>



</body>

</html>