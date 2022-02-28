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
    $miConsulta = $miPDO->prepare('SELECT * FROM libros WHERE titulo LIKE CONCAT("%", :titulo, "%")');
    $miConsulta->execute(['titulo' => $titulo]);
} else {
    $miConsulta = $miPDO->prepare('SELECT * FROM libros;');
    $miConsulta->execute();
}
$sql = ' SELECT l.*, 
                   autor.nombre as autor, 
                    categoria.nombre as categoria,
                        editorial.nombre as editorial

        FROM libros l
        LEFT JOIN autor ON l.id_autor = autor.id_autor
        LEFT JOIN editorial ON l.id_editorial = editorial.id_editorial
        LEFT JOIN categoria ON l.id_categoria = categoria.id_categoria';

$stmt = $miPDO->prepare($sql);
$stmt->execute();
$datos = $stmt->fetchAll();



echo $blade->run("libros.index", [
    "datos" => $datos
]);
?>
