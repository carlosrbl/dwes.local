<?php
require_once "../src/utils/file.class.php";
require_once "../src/entity/asociado.class.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $nombre = trim(htmlspecialchars($_POST['nombre']) ?? "");
        $descripcion = trim(htmlspecialchars($_POST['descripcion']) ?? "");

        $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
        $imagen = new File('imagen', $tiposAceptados);

        $imagen->saveUploadFile(Asociado::RUTA_LOGOS_ASOCIADOS);

        $mensaje = 'Datos enviados';
    } catch (FileException $fileException) {
        $errores[] = $fileException->getMessage();
    }
} else {
    $errores = [];
    $nombre = "";
    $descripcion = "";
    $mensaje = "";
}
require_once __DIR__ . "/views/asociados.view.php";
