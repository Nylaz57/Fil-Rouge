<?php
// Nom du cookie , Valeur du cookie (vide) , temps expiration ( expire 1000 Millisecondes avant l'heure actuelle, ce qui entraîne son expiration immédiate.)
session_start();
setcookie('PHPSESSID', '', time() - 1000);
session_destroy();
header('Location: /index.php');
die;
