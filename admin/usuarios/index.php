<?php
session_start();
if ($_SESSION['usuario']['tipo'] != "admin"){
    die('Usuario no autorizado');
}
require "../../config.php";
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
    $miConsulta = $miPDO->prepare('SELECT * FROM usuarios where first_name like CONCAT("%", :nombre, "%")');
    $miConsulta->execute(['nombre' => $nombre]);
} else {
    $miConsulta = $miPDO->prepare('SELECT * FROM usuarios;');
    $miConsulta->execute();
}

$datos = $miConsulta->fetchAll();

echo $blade->run("usuarios.index", [
    "datos" => $datos
]);
?>
