<?php
session_start();

require "../../config.php";
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recogemos variables
    $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;


    // Prepara INSERT
    $miInsert = $miPDO->prepare('INSERT INTO categoria (nombre) VALUES (:nombre)');
    // Ejecuta INSERT con los datos
    $miInsert->execute(
        [
            'nombre' => $nombre,

        ]
    );

    $_SESSION["mensajes"] = "Registro añadido correctamente.";

    // Redireccionamos a Leer
    header('Location: index.php');
}

echo $blade->run("categorias.nuevo", []);
?>
