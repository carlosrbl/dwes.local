<?php
session_start();
require_once "src/utils/file.class.php";
require_once "src/entity/imagen.class.php";
require_once "src/entity/categoria.class.php";
require_once "src/database/connection.class.php";
require_once "src/repository/imagenesRepository.class.php";
require_once "src/repository/categoriasRepository.class.php";

$errores = [];
$imagenes = [];
$descripcion = '';
$titulo = '';
$mensaje = '';

if (isset($_SESSION['errores_post'])) {
    $errores = $_SESSION['errores_post'];
    unset($_SESSION['errores_post']);
}

if (isset($_SESSION['mensaje_exito'])) {
    $mensaje = $_SESSION['mensaje_exito'];
    unset($_SESSION['mensaje_exito']);
}

try {
    $imagenesRepository = new ImagenesRepository();
    $categoriasRepository = new CategoriasRepository();

    $imagenes = $imagenesRepository->findAll();
    $categorias = $categoriasRepository->findAll();

} catch (QueryException $queryException) {
    $errores[] = $queryException->getMessage();
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
}

require_once __DIR__ . "/../views/galeria.view.php";
