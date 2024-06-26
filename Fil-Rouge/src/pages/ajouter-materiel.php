<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['statut'] === 4) {
    require '../src/data/db-connect.php';
    $titre = "Ajout d'un matériel";
}
