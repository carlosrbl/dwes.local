<?php
require_once "src/utils/file.class.php";
require_once "src/entity/imagen.class.php";
require_once "src/database/connection.class.php";
require_once "src/repository/imagenesRepository.class.php";

$errores = [];
$imagenes = [];
$descripcion = '';
$mensaje = '';

try {
    $imagenesRepository = new ImagenesRepository();
    $imagenes = $imagenesRepository->findAll();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = trim(htmlspecialchars($_POST['titulo']) ?? "");
        $descripcion = trim(htmlspecialchars($_POST['descripcion']) ?? "");

        $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
        $imagen = new File('imagen', $tiposAceptados);

        $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);

        $imagenGaleria = new Imagen($imagen->getFileName(), $descripcion);
        $imagenesRepository->save($imagenGaleria);
        $mensaje = "Se ha guardado la imagen correctamente";
        $imagenes = $imagenesRepository->findAll();
    } else {
        $titulo = "";
        $descripcion = "";
    }
} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
    $errores[] = $fileException->getMessage();
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
}
require_once __DIR__ . "/../views/galeria.view.php";
