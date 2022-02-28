<?php
session_start();

require "../../config.php";
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache);

// Obtiene codigo del libro a borrar
$id_categoria = isset($_REQUEST['id_categoria']) ? $_REQUEST['id_categoria'] : null;

// Prepara DELETE
$miConsulta = $miPDO->prepare('DELETE FROM categoria WHERE id_categoria = :id_categoria');

// Ejecuta la sentencia SQL
$miConsulta->execute([
    "id_categoria" => $id_categoria
]);

$_SESSION["mensajes"] = "Registro eliminado correctamente.";

// Redireccionamos al PHP con todos los datos
header('Location: index.php');

$datos = $miConsulta->fetchAll();

echo $blade->run("categorias.borrar", [
    "datos" => $datos,
    "id_categoria" => $id_categoria,
]);
?>
