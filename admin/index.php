<?php
session_start();
if ($_SESSION['usuario']['tipo'] != "admin"){
    die('Usuario no autorizado');
}

require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../views';
$cache = '../cache';

$blade = new BladeOne($views, $cache);

echo $blade->run("admin.index", []);
?>
