<?php
session_start();
require_once "src/utils/file.class.php";
require_once "src/entity/asociado.class.php";
require_once "src/database/connection.class.php";
require_once "src/repository/asociadosRepository.class.php";

$errores = [];
$descripcion = '';
$nombre = '';
$mensaje = '';

if (isset($_SESSION['errores_post'])) {
    $errores = $_SESSION['errores_post'];
    unset($_SESSION['errores_post']);
}

if (isset($_SESSION['mensaje_exito'])) {
    $mensaje = $_SESSION['mensaje_exito'];
    unset($_SESSION['mensaje_exito']);
}

require_once __DIR__ . "/../views/asociados.view.php";