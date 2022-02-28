<?php
session_start();

require "../../config.php";
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache);
$id_categoria = isset($_REQUEST['id_categoria']) ? $_REQUEST['id_categoria'] : null;
$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Prepara UPDATE

    $miUpdate = $miPDO->prepare('UPDATE categoria SET nombre = :nombre WHERE id_categoria = :id_categoria');
// Ejecuta UPDATE con los datos
    $miUpdate->execute(
        [
            'id_categoria' => $id_categoria,
            'nombre' => $nombre,

        ]
    );
// Redireccionamos a Leer
    header('Location: index.php');
} else {
// Prepara SELECT
    $miConsulta = $miPDO->prepare('SELECT * FROM categoria WHERE id_categoria = :id_categoria;');
// Ejecuta consulta
    $miConsulta->execute(
        [
            "id_categoria" => $id_categoria
        ]
    );
}

// Obtiene un resultado
$datos = $miConsulta->fetch();

echo $blade->run("categorias.modificar", [
    "datos" => $datos,
    "id_categoria" => $id_categoria,
]);
?>
