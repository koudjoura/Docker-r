<?php

$name_server = "yesko";
$db_name = "gestionStock";
$db_user = "root";
$db_pass = "root";

try {
    $connexion = new PDO("mysql:host=$name_server;dbname=$db_name", $db_user, $db_pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
