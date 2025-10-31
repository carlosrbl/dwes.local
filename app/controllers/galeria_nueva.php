<?php
session_start();
require_once "src/repository/imagenesRepository.class.php";
require_once "src/utils/file.class.php";
try {
    $imagenesRepository = new ImagenesRepository();

    $titulo = trim(htmlspecialchars($_POST['titulo']) ?? "");
    $descripcion = trim(htmlspecialchars($_POST['descripcion']) ?? "");

    $categoria = trim(htmlspecialchars($_POST['categoria']));
    if (empty($categoria))
        throw new CategoriaException;

    $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
    $imagen = new File('imagen', $tiposAceptados);

    $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);

    $imagenGaleria = new Imagen($imagen->getFileName(), $descripcion, $categoria);
    $imagenesRepository->guarda($imagenGaleria);
    
    App::get('logger')->add("Se ha guardado una imagen: ".$imagenGaleria->getNombre());
    $_SESSION['mensaje_exito'] = "Se ha guardado la imagen correctamente";
} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
    $_SESSION['errores_post'] = $errores;
} catch (QueryException $queryException) {
    $errores[] = $queryException->getMessage();
    $_SESSION['errores_post'] = $errores;
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
    $_SESSION['errores_post'] = $errores;
} catch (CategoriaException) {
    $errores[] = "No se ha seleccionado una categoría válida";
    $_SESSION['errores_post'] = $errores;
}

App::get('router')->redirect('galeria');
