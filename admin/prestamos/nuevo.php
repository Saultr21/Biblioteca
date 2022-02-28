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
    $id_libro = isset($_REQUEST['id_libro']) ? $_REQUEST['id_libro'] : null;
    $id_usuario = isset($_REQUEST['id_usuario']) ? $_REQUEST['id_usuario'] : null;
    $fecha_devolucion = isset($_REQUEST['fecha_devolucion']) ? $_REQUEST['fecha_devolucion'] : null;


    // Prepara INSERT
    $miInsert = $miPDO->prepare('INSERT INTO prestamos (id_libro,id_usuario,fecha_devolucion) 
VALUES (:id_libro,:id_usuario,:fecha_devolucion)');
    // Ejecuta INSERT con los datos
    $miInsert->execute(
        array(
            'id_libro' => $id_libro,
            'id_usuario' => $id_usuario,
            'fecha_devolucion' => $fecha_devolucion,

        )
    );

    $_SESSION["mensajes"] = "Registro añadido correctamente.";

    // Redireccionamos a Leer
    header('Location: index.php');
}


$stmt = $miPDO->prepare('SELECT * FROM libros where disponible = 1;');
$stmt->execute();
$libro = $stmt->fetchAll();

$stmt = $miPDO->prepare('SELECT * FROM usuarios u where (NOT EXISTS (select * from sanciones s where u.id = s.id_usuario ) and activo = "Si") 
                           and (EXISTS (select * from prestamos group by id_usuario having count(id_usuario)<=1)and activo = "Si");');
$stmt->execute();
$usuarios = $stmt->fetchAll();

$stmt = $miPDO->prepare('select * from prestamos group by id_usuario having count(id_usuario)>1');
$stmt->execute();
$max_prestamos = $stmt->fetchAll();


echo $blade->run("prestamos.nuevo", [
    'libro' => $libro,
    'usuarios' => $usuarios,
    'max_prestamos' => $max_prestamos



]);
?>

