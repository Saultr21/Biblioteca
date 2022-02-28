<?php
session_start();

require "../../config.php";
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache);

// Obtiene codigo del libro a borrar
$codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;

// Prepara DELETE
$miConsulta = $miPDO->prepare('DELETE FROM libros WHERE codigo = :codigo');

// Ejecuta la sentencia SQL
$miConsulta->execute([
    "codigo" => $codigo
]);

$_SESSION["mensajes"] = "Registro eliminado correctamente.";

// Redireccionamos al PHP con todos los datos
header('Location: index.php');

$datos = $miConsulta->fetchAll();

echo $blade->run("libros.borrar", [
    "datos" => $datos,
    "codigo" => $codigo,
]);
?>
