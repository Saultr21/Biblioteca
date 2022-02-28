<?php
session_start();

require "../../config.php";
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache);
$id_autor = isset($_REQUEST['id_autor']) ? $_REQUEST['id_autor'] : null;
$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
$apellidos = isset($_REQUEST['apellidos']) ? $_REQUEST['apellidos'] : null;
$fecha_nacimiento = isset($_REQUEST['fecha_nacimiento']) ? $_REQUEST['fecha_nacimiento'] : null;
$fecha_fallecimiento = isset($_REQUEST['fecha_fallecimiento']) ? $_REQUEST['fecha_fallecimiento'] : null;
$lugar_nacimiento = isset($_REQUEST['lugar_nacimiento']) ? $_REQUEST['lugar_nacimiento'] : null;
$biografia = isset($_REQUEST['biografia']) ? $_REQUEST['biografia'] : null;
$foto = isset($_REQUEST['foto']) ? $_REQUEST['foto'] : null;

// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE
    $miUpdate = $miPDO->prepare('UPDATE autor SET nombre = :nombre,apellidos = :apellidos,fecha_nacimiento = :fecha_nacimiento,
                 fecha_fallecimiento = :fecha_fallecimiento,lugar_nacimiento = :lugar_nacimiento,
                 biografia = :biografia,foto = :foto WHERE id_autor = :id_autor');
    // Ejecuta UPDATE con los datos
    $miUpdate->execute(
        [
            'id_autor' => $id_autor,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'fecha_nacimiento' => $fecha_nacimiento,
            'fecha_fallecimiento' => $fecha_fallecimiento,
            'lugar_nacimiento' => $lugar_nacimiento,
            'biografia' => $biografia,
            'foto' => $foto,

        ]
    );
// Redireccionamos a Leer
    header('Location: index.php');
} else {
// Prepara SELECT
    $miConsulta = $miPDO->prepare('SELECT * FROM autor WHERE id_autor = :id_autor;');
// Ejecuta consulta
    $miConsulta->execute(
        [
            'id_autor' => $id_autor,

        ]
    );
}

// Obtiene un resultado
$datos = $miConsulta->fetch();

echo $blade->run("autor.modificar", [
    "datos" => $datos,
    'id_autor' => $id_autor,
    'nombre' => $nombre,
    'apellidos' => $apellidos,
    'fecha_nacimiento' => $fecha_nacimiento,
    'fecha_fallecimiento' => $fecha_fallecimiento,
    'lugar_nacimiento' => $lugar_nacimiento,
    'biografia' => $biografia,
    'foto' => $foto,
]);
?>
