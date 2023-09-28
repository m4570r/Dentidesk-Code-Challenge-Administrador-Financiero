<?php

$host = '192.168.1.139';
$dbname = 'codechallenge';
$username = 'docker';
$password = '171279879';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error en la conexión a la base de datos: ' . $e->getMessage());
}
