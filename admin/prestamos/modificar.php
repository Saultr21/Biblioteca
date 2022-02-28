<?php
session_start();

require "../../config.php";
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache);
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
$codigo = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
$id_libro = isset($_REQUEST['id_libro']) ? $_REQUEST['id_libro'] : null;
$id_usuario = isset($_REQUEST['id_usuario']) ? $_REQUEST['id_usuario'] : null;
$fecha_prestamo = isset($_REQUEST['fecha_prestamo']) ? $_REQUEST['fecha_prestamo'] : null;
$fecha_devolucion = isset($_REQUEST['fecha_devolucion']) ? $_REQUEST['fecha_devolucion'] : null;
$devuelto = isset($_REQUEST['devuelto']) ? $_REQUEST['devuelto'] : null;
// Prepara SELECT
$miConsulta = $miPDO->prepare('SELECT * FROM prestamos WHERE id = :id;');
// Ejecuta consulta
$miConsulta->execute(
    [
        'id' => $id,

    ]
);
$datos = $miConsulta->fetch();



// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE
    $miUpdate = $miPDO->prepare('UPDATE prestamos SET id =:id,id_libro = :id_libro,id_usuario = :id_usuario,fecha_prestamo = :fecha_prestamo,
                 fecha_devolucion = :fecha_devolucion, devuelto = :devuelto WHERE id = :id');

    // Ejecuta UPDATE con los datos
    $miUpdate->execute(
        [
            'id' => $id,
            'id_libro' => $id_libro,
            'id_usuario' => $id_usuario,
            'fecha_prestamo' => $fecha_prestamo,
            'fecha_devolucion' => $fecha_devolucion,
            'devuelto' => $devuelto,



        ]
    );

    if(strtotime($devuelto) > strtotime($fecha_devolucion)) {
        $miInsert = $miPDO->prepare('INSERT INTO sanciones (id_usuario,motivo,fecha_fin) VALUES (:id_usuario,"Retraso en entrega",DATE_ADD(CURRENT_DATE, interval 5 day))');


        // Ejecuta INSERT con los datos
        $miInsert->execute(
            array(
                'id_usuario' => $id_usuario,

            )
        );
    }

    header('Location: index.php');

}
// Redireccionamos a Leer
    /*
    var_dump($miPDO-> errorInfo());
    var_dump($miUpdate -> debugDumpParams());
    exit;
    */

// Obtiene un resultado


$stmt = $miPDO->prepare('SELECT * FROM libros;');
$stmt->execute();
$libro = $stmt->fetchAll();

$stmt = $miPDO->prepare('SELECT * FROM usuarios;');
$stmt->execute();
$usuarios = $stmt->fetchAll();



echo $blade->run("prestamos.modificar", [
    'id' => $id,
    'datos' => $datos,
    'libro' => $libro,
    'usuarios' => $usuarios,

]);
?>
