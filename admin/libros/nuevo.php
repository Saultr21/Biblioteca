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
    $codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
    $titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : null;
    $id_autor = isset($_REQUEST['id_autor']) ? $_REQUEST['id_autor'] : null;
    $id_categoria = isset($_REQUEST['id_categoria']) ? $_REQUEST['id_categoria'] : null;
    $id_editorial = isset($_REQUEST['id_editorial']) ? $_REQUEST['id_editorial'] : null;
    $disponible = isset($_REQUEST['disponible']) ? $_REQUEST['disponible'] : null;
    $foto = isset($_REQUEST['foto']) ? $_REQUEST['foto'] : '';
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

    // Prepara INSERT
    $miInsert = $miPDO->prepare('INSERT INTO libros (titulo,id_autor,id_categoria,id_editorial,foto,disponible) 
VALUES (:titulo,:id_autor,:id_categoria,:id_editorial,:foto,:disponible)');
    // Ejecuta INSERT con los datos
    $miInsert->execute(
        array(
            'titulo' => $titulo,
            'id_autor' => $id_autor,
            'id_categoria' => $id_categoria,
            'id_editorial' => $id_editorial,
            'foto' => $foto,
            'disponible' => $disponible,

        )
    );

    $_SESSION["mensajes"] = "Registro añadido correctamente.";

    // Redireccionamos a Leer
    header('Location: index.php');
}


$stmt = $miPDO->prepare('SELECT * FROM autor;');
$stmt->execute();
$autor = $stmt->fetchAll();

$stmt = $miPDO->prepare('SELECT * FROM categoria;');
$stmt->execute();
$categoria = $stmt->fetchAll();

$stmt = $miPDO->prepare('SELECT * FROM editorial;');
$stmt->execute();
$editorial = $stmt->fetchAll();

echo $blade->run("libros.nuevo", [
    'autor' => $autor,
    'categoria' => $categoria,
    'editorial' => $editorial,
]);
?>

