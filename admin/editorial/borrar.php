<?php
session_start();

require "../../config.php";
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache);

// Obtiene codigo del libro a borrar
$id_editorial = isset($_REQUEST['id_editorial']) ? $_REQUEST['id_editorial'] : null;

// Prepara DELETE
$miConsulta = $miPDO->prepare('DELETE FROM editorial WHERE id_editorial = :id_editorial');

// Ejecuta la sentencia SQL
$miConsulta->execute([
    "id_editorial" => $id_editorial
]);

$_SESSION["mensajes"] = "Registro eliminado correctamente.";

// Redireccionamos al PHP con todos los datos
header('Location: index.php');

$datos = $miConsulta->fetchAll();

echo $blade->run("editorial.borrar", [
    "datos" => $datos,
    "id_editorial" => $id_editorial
]);
?>
