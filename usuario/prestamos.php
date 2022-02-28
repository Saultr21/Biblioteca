<?php
session_start();

require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../views';
$cache = '../cache';

$blade = new BladeOne($views, $cache);

//echo $_SESSION['usuario'];
//print_r($_SESSION['usuario']);
include "../config.php";

try {
$dns = "mysql:host=$host;dbname=$base_de_datos;";

$miPDO = new PDO($dns, $usuario, $password);

} catch (PDOException $error) {
echo "Error: " . $error->getMessage();
}



$id = isset($_SESSION['usuario']['id']) ? ($_SESSION['usuario']['id']) : null;
$miConsulta = $miPDO->prepare('SELECT * FROM usuarios where id = :id');
$miConsulta->execute(['id' => $id]);

$sql = ' SELECT p.*, 
                   libros.titulo as titulo, 
                    usuarios.first_name as usuario

        FROM prestamos p
        LEFT JOIN libros ON p.id_libro = libros.codigo
        LEFT JOIN usuarios ON p.id_usuario = usuarios.id
        where id_usuario = :id';

$stmt = $miPDO->prepare($sql);
$stmt->execute(['id' => $id]);
$nombres = $stmt->fetchAll();

$stmt = $miPDO->prepare('SELECT * FROM prestamos where id_usuario = :id');
$stmt->execute(['id' => $id]);
$prestamos = $stmt->fetchAll();

$stmt = $miPDO->prepare('SELECT * FROM sanciones where id_usuario = :id');
$stmt->execute(['id' => $id]);
$sanciones = $stmt->fetchAll();

$datos = $miConsulta->fetchAll();

echo $blade->run("usuario.prestamos", [
    "datos" => $datos,
    'prestamos' => $prestamos,
    'sanciones' => $sanciones,
    'nombres' => $nombres,
]);
?>