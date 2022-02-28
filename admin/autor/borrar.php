<?php
session_start();

require "../../config.php";
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache);

// Obtiene codigo del libro a borrar
$id_autor = isset($_REQUEST['id_autor']) ? $_REQUEST['id_autor'] : null;

// Prepara DELETE
$miConsulta = $miPDO->prepare('DELETE FROM autor WHERE id_autor = :id_autor');

// Ejecuta la sentencia SQL
$miConsulta->execute([
    "id_autor" => $id_autor
]);

$_SESSION["mensajes"] = "Registro eliminado correctamente.";

// Redireccionamos al PHP con todos los datos
header('Location: index.php');

$datos = $miConsulta->fetchAll();

echo $blade->run("autor.borrar", [
    "datos" => $datos,
    "id_autor" => $id_autor,
]);
?>
