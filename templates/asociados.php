<?php
session_start();
require_once "../src/utils/file.class.php";
require_once "../src/entity/asociado.class.php";
require_once "../src/database/connection.class.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $nombre = trim(htmlspecialchars($_POST['nombre'] ?? ""));
        $descripcion = trim(htmlspecialchars($_POST['descripcion'] ?? ""));
        $errores = [];

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

            $conexion = Connection::make();
            $sql = "INSERT INTO asociados (nombre, logo, descripcion) VALUES (:nombre,:logo,:descripcion)";
            $pdoStatement = $conexion->prepare($sql);
            $parametros = [
                ':nombre' => $nombre,
                ':logo' => $imagen->getFileName(),
                ':descripcion' => $descripcion
            ];
            if ($pdoStatement->execute($parametros) === false)
                $errores[] = "No se ha podido guardar la imagen en la base de datos";
            else {
                $descripcion = "";
                $mensaje = "Se ha guardado la imagen correctamente";
            }
        } else {
            $mensaje = "";
        }
    } catch (FileException $fileException) {
        $errores[] = $fileException->getMessage();
        $mensaje = "";
    }
} else {
    $errores = [];
    $nombre = "";
    $descripcion = "";
    $mensaje = "";
}

require_once __DIR__ . "/views/asociados.view.php";
