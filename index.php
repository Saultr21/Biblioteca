<?php

session_start();
require "vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';

$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);


// Variables necesarias para conectar con la base de datos de MySQL.
include "config.php";

try {
    $dns = "mysql:host=$host;dbname=$base_de_datos;";

    $miPDO = new PDO($dns, $usuario, $password);

} catch (PDOException $error) {
    echo "Error: " . $error->getMessage();
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
$libros = $stmt->fetchAll();


echo $blade->run("index",
    [
        "libros" => $libros,

    ]);
/*
<div class="container text-center mt-5">
    <p><a class="btn btn-primary text-center" href="../../../Biblioteca/login.php">Iniciar sesión administración</a></p>
</div>
*/?>