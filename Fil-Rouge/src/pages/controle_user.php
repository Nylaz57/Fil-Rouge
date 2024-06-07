<?php


try {

    // parametre de la bdd
    $host = "localhost";
    $dbname = "mns-loc";
    $user = "root";
    $pwd = "";

    // conexxion a la bdd en utilisant PDO
    $connect = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);

    $query = "SELECT count(*) as nb from utilisateur where email ='" . $_GET['email'] . "'";
    $result = $connect->prepare($query);
    $result->execute();

    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    echo (json_encode($data));

} catch (PDOException $e) {
    echo "Erreur" . $e->getmessage();
    die;
}




