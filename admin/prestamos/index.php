<?php
session_start();
if ($_SESSION['usuario']['tipo'] != "admin"){
    die('Usuario no autorizado');
}
require "../../config.php";
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
    $miConsulta = $miPDO->prepare('SELECT * FROM prestamos WHERE id_usuario LIKE CONCAT("%", :titulo, "%")');
    $miConsulta->execute(['titulo' => $titulo]);
} else {
    $miConsulta = $miPDO->prepare('SELECT * FROM prestamos;');
    $miConsulta->execute();
}



$sql = 'SELECT l.*, 
                   usuarios.first_name as usuario, 
                    libros.titulo as libro,
                        DATEDIFF(fecha_devolucion, CURRENT_TIMESTAMP) AS "dias_restantes"

        FROM prestamos l
        LEFT JOIN usuarios ON l.id_usuario = usuarios.id
        LEFT JOIN libros ON l.id_libro = libros.codigo
        ';

$stmt = $miPDO->prepare($sql);
$stmt->execute();
$datos = $stmt->fetchAll();


$sql2 = 'SELECT id_usuario, COUNT(*) as Repetidos
FROM prestamos  
GROUP BY id_usuario
having count(*)>1';

$stmt = $miPDO->prepare($sql2);
$stmt->execute();
$contador = $stmt->fetchAll();

$stmt = $miPDO->prepare('SELECT * FROM usuarios u WHERE EXISTS (SELECT * FROM sanciones s WHERE u.id = s.id_usuario)');
$stmt->execute();
$sanciones = $stmt->fetchAll();


echo $blade->run("prestamos.index", [
    "datos" => $datos,
    'contador' => $contador,
    'sanciones' => $sanciones,

]);
?>
