<?php

try {
    $host = 'localhost';
    $dbname = 'mns-loc';
    $username = 'root';
    $password = '';

    $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die;
}
