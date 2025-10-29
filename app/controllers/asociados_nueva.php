<?php
session_start();
require_once "src/repository/asociadosRepository.class.php";
require_once "src/entity/asociado.class.php";
require_once "src/utils/file.class.php";
try {
    $asociadosRepository = new AsociadosRepository();

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

        $imagenAsociado = new Asociado($nombre, $imagen->getFileName(), $descripcion);
        $asociadosRepository->save($imagenAsociado);
        $_SESSION['mensaje_exito'] = "Se ha guardado el asociado correctamente";
    }
    else {
        $_SESSION['errores_post'] = $errores;
    }
} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
    $_SESSION['errores_post'] = $errores;
} catch (QueryException $queryException) {
    $errores[] = $queryException->getMessage();
    $_SESSION['errores_post'] = $errores;
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
    $_SESSION['errores_post'] = $errores;
}

App::get('router')->redirect('asociados');
