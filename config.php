<?php
$host = 'localhost';
$base_de_datos = 'biblioteca';
$usuario = 'root';
$password = '';

try {
    $hostPDO = "mysql:host=$host;dbname=$base_de_datos;";

    $miPDO = new PDO($hostPDO, $usuario, $password);
    $miPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Error: ".$e->getMessage();
    die();
}
