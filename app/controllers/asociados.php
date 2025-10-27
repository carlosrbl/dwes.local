<?php
session_start();
require_once "src/utils/file.class.php";
require_once "src/entity/asociado.class.php";
require_once "src/database/connection.class.php";
require_once "src/repository/asociadosRepository.class.php";

$errores = [];
$descripcion = '';
$mensaje = '';

try {
    $asociadosRepository = new AsociadosRepository();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = trim(htmlspecialchars($_POST['nombre'] ?? ""));
        $descripcion = trim(htmlspecialchars($_POST['descripcion'] ?? ""));

        if ($nombre == "") {
            $errores[] = "El nombre no debe estar vacío";
        }

        $captcha = $_POST['captcha'] ?? "";
        if ($captcha == "") {
            $errores[] = "Introduzca el código de seguridad";
        } else if ($_SESSION['captchaGenerado'] != $captcha) {
            $errores[] = "¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo";
        }

        if (empty($errores)) {
            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
            $imagen = new File('imagen', $tiposAceptados);
            
            $imagen->saveUploadFile(Asociado::RUTA_LOGOS_ASOCIADOS);

            $imagenAsociado = new Asociado($nombre,$imagen->getFileName(),$descripcion);
            $asociadosRepository->save($imagenAsociado);
            $mensaje = "Se ha guardado la imagen correctamente";
        }
    }
    else {
        $nombre = "";
        $descripcion = "";
    }

} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
    $errores[] = $fileException->getMessage();
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
}
require_once __DIR__ . "/../views/asociados.view.php";