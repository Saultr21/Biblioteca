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
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
    $id_usuario = isset($_REQUEST['id_usuario']) ? $_REQUEST['id_usuario'] : null;
    $motivo = isset($_REQUEST['motivo']) ? $_REQUEST['motivo'] : null;
    $fecha_fin = isset($_REQUEST['fecha_fin']) ? $_REQUEST['fecha_fin'] : null;





    // Prepara INSERT
    $miInsert = $miPDO->prepare('INSERT INTO sanciones (id_usuario,motivo,fecha_fin) VALUES (:id_usuario,:motivo,DATE_ADD(CURRENT_DATE, interval 5 day))');


    // Ejecuta INSERT con los datos
    $miInsert->execute(
        array(
            'id_usuario' => $id_usuario,
            'motivo' => $motivo

        )
    );

    $_SESSION["mensajes"] = "Registro añadido correctamente.";

    // Redireccionamos a Leer
    header('Location: index.php');
}


$stmt = $miPDO->prepare('SELECT * FROM libros;');
$stmt->execute();
$libro = $stmt->fetchAll();

$stmt = $miPDO->prepare('SELECT * FROM usuarios;');
$stmt->execute();
$usuarios = $stmt->fetchAll();



echo $blade->run("sanciones.nuevo", [
    'libro' => $libro,
    'usuarios' => $usuarios,

]);
?>

