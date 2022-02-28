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
    $first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : null;
    $last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : null;
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
    $options = array("cost" => 4);
    $hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);
    $tipo = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : null;

    // Prepara INSERT
    $miInsert = $miPDO->prepare('INSERT INTO usuarios (first_name,last_name,email,`password`,tipo) VALUES (:first_name,:last_name,
                                                                     :email,:pass,:tipo)');
    // Ejecuta INSERT con los datos
    $miInsert->execute(
        array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            ':pass'=>$hashPassword,
            'tipo' => $tipo,
        )
    );

    $_SESSION["mensajes"] = "Registro añadido correctamente.";

    // Redireccionamos a Leer
    header('Location: index.php');
}

echo $blade->run("usuarios.nuevo", []);
?>
