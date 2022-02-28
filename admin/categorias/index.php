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
    $titulo = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
    $miConsulta = $miPDO->prepare('SELECT * FROM categoria WHERE nombre LIKE CONCAT("%", :titulo, "%")');
    $miConsulta->execute(['titulo' => $titulo]);
} else {
    $miConsulta = $miPDO->prepare('SELECT * FROM categoria;');
    $miConsulta->execute();
}

$datos = $miConsulta->fetchAll();

echo $blade->run("categorias.index", [
    "datos" => $datos
]);
?>
