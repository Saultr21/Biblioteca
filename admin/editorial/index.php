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
    $miConsulta = $miPDO->prepare('SELECT * FROM editorial where nombre like CONCAT("%", :nombre, "%")');
    $miConsulta->execute(['nombre' => $nombre]);
} else {
    $miConsulta = $miPDO->prepare('SELECT * FROM editorial;');
    $miConsulta->execute();
}

$datos = $miConsulta->fetchAll();

echo $blade->run("editorial.index", [
    "datos" => $datos
]);
?>
