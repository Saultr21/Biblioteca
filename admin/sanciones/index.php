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
    $miConsulta = $miPDO->prepare('SELECT * FROM sanciones WHERE motivo LIKE CONCAT("%", :titulo, "%")');
    $miConsulta->execute(['titulo' => $titulo]);
} else {
    $miConsulta = $miPDO->prepare('SELECT * FROM sanciones;');
    $miConsulta->execute();
}
$sql = 'SELECT l.*, 
                   usuarios.first_name as usuario


        FROM sanciones l
        LEFT JOIN usuarios ON l.id_usuario = usuarios.id';

$stmt = $miPDO->prepare($sql);
$stmt->execute();
$datos = $stmt->fetchAll();


echo $blade->run("sanciones.index", [
    "datos" => $datos,

]);
?>
