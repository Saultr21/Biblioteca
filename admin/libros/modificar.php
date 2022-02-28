<?php
session_start();

require "../../config.php";
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache);
$codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
$titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : null;
$id_autor = isset($_REQUEST['id_autor']) ? $_REQUEST['id_autor'] : null;
$id_categoria = isset($_REQUEST['id_categoria']) ? $_REQUEST['id_categoria'] : null;
$id_editorial = isset($_REQUEST['id_editorial']) ? $_REQUEST['id_editorial'] : null;
$disponible = isset($_REQUEST['disponible']) ? $_REQUEST['disponible'] : null;
$foto = !empty($_REQUEST['foto']) ? $_REQUEST['foto'] : null;

if (!empty($_FILES['foto']['name'])){
$foto = $_FILES['foto']['name'];
$formato = $_FILES['foto']['type'];
$size = $_FILES['foto']['size'];

if (!empty($foto) && ($size <= 200000000)) {
    if (($formato == "image/gif")
        || ($formato == "image/jpeg")
        || ($formato == "image/jpg")
        || ($formato == "image/png"))
    {
        $directorio ='../imagenes/';
        move_uploaded_file($_FILES['foto']['tmp_name'],$directorio.$foto);
    }else {
        echo "No se puede subir una foto con este formato";
    }
}else {
    if($foto == !NULL) echo "La foto es demasiado grande";
}
}
// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE
    $miUpdate = $miPDO->prepare('UPDATE libros SET titulo = :titulo,id_autor = :id_autor,id_categoria = :id_categoria,
                 id_editorial = :id_editorial,foto = :foto,disponible = :disponible WHERE codigo = :codigo');
    // Ejecuta UPDATE con los datos
    $miUpdate->execute(
        [
            'codigo' => $codigo,
            'titulo' => $titulo,
            'id_autor' => $id_autor,
            'id_categoria' => $id_categoria,
            'id_editorial' => $id_editorial,
            'foto' => $foto,
            'disponible' => $disponible,


        ]
    );
// Redireccionamos a Leer
    /*
    var_dump($miPDO-> errorInfo());
    var_dump($miUpdate -> debugDumpParams());
    exit;
    */
    header('Location: index.php');
} else {
// Prepara SELECT
    $miConsulta = $miPDO->prepare('SELECT * FROM libros WHERE codigo = :codigo;');
// Ejecuta consulta
    $miConsulta->execute(
        [
            'codigo' => $codigo,

        ]
    );
}

// Obtiene un resultado
$datos = $miConsulta->fetch();

$stmt = $miPDO->prepare('SELECT * FROM autor;');
$stmt->execute();
$autor = $stmt->fetchAll();

$stmt = $miPDO->prepare('SELECT * FROM categoria;');
$stmt->execute();
$categoria = $stmt->fetchAll();

$stmt = $miPDO->prepare('SELECT * FROM editorial;');
$stmt->execute();
$editorial = $stmt->fetchAll();

echo $blade->run("libros.modificar", [
    "datos" => $datos,
    'codigo' => $codigo,
    'autor' => $autor,
    'foto' => $foto,
    'categoria' => $categoria,
    'editorial' => $editorial,
]);
?>
