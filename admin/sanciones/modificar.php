<?php
session_start();

require "../../config.php";
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache);
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
$id_usuario = isset($_REQUEST['id_usuario']) ? $_REQUEST['id_usuario'] : null;
$motivo = isset($_REQUEST['motivo']) ? $_REQUEST['motivo'] : null;
$fecha_inicio = isset($_REQUEST['fecha_inicio']) ? $_REQUEST['fecha_inicio'] : null;
$fecha_fin = isset($_REQUEST['fecha_fin']) ? $_REQUEST['fecha_fin'] : null;

// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE
    $miUpdate = $miPDO->prepare('UPDATE sanciones SET id_usuario = :id_usuario,motivo = :motivo,fecha_inicio = :fecha_inicio,
                 fecha_fin = :fecha_fin WHERE id = :id');
    // Ejecuta UPDATE con los datos
    $miUpdate->execute(
        [
            'id' => $id,
            'id_usuario' => $id_usuario,
            'motivo' => $motivo,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,



        ]
    );
// Redireccionamos a Leer
    /*
    var_dump($miPDO-> errorInfo());
    var_dump($miUpdate -> debugDumpParams());
    exit;
    */
    header('Location: index.php');
} else {
// Prepara SELECT
    $miConsulta = $miPDO->prepare('SELECT * FROM sanciones WHERE id = :id;');
// Ejecuta consulta
    $miConsulta->execute(
        [
            'id' => $id,

        ]
    );
}

// Obtiene un resultado
$datos = $miConsulta->fetch();

$stmt = $miPDO->prepare('SELECT * FROM libros;');
$stmt->execute();
$libro = $stmt->fetchAll();

$stmt = $miPDO->prepare('SELECT * FROM usuarios;');
$stmt->execute();
$usuarios = $stmt->fetchAll();



echo $blade->run("sanciones.modificar", [
    'id' => $id,
    'datos' => $datos,
    'libro' => $libro,
    'usuarios' => $usuarios,

]);
?>
