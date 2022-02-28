<?php
session_start();

require "../../config.php";
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache);

// Obtiene codigo del libro a borrar
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

// Prepara DELETE
$miConsulta = $miPDO->prepare('DELETE FROM usuarios WHERE id = :id');

// Ejecuta la sentencia SQL
$miConsulta->execute([
    "id" => $id
]);

$_SESSION["mensajes"] = "Registro eliminado correctamente.";

// Redireccionamos al PHP con todos los datos
header('Location: index.php');

$datos = $miConsulta->fetchAll();

echo $blade->run("usuarios.borrar", [
    "datos" => $datos,
    "id" => $id
]);
?>
