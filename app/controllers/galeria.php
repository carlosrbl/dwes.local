<?php
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

try {
    $imagenesRepository = new ImagenesRepository();
    $imagenes = $imagenesRepository->findAll();

    $categoriaRepository = new CategoriasRepository();
    $categorias = $categoriaRepository->findAll();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = trim(htmlspecialchars($_POST['titulo']) ?? "");
        $descripcion = trim(htmlspecialchars($_POST['descripcion']) ?? "");

        $categoria = trim(htmlspecialchars($_POST['categoria']));
        if (empty($categoria))
            throw new CategoriaException;

        $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
        $imagen = new File('imagen', $tiposAceptados);

        $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);

        $imagenGaleria = new Imagen($imagen->getFileName(), $descripcion,$categoria);
        $imagenesRepository->guarda($imagenGaleria);
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
} catch (CategoriaException) {
 $errores[] = "No se ha seleccionado una categoría válida";
}
require_once __DIR__ . "/../views/galeria.view.php";
