<?php
// Plantilla de Carlos Rodrigo Beltrá 2º DAW

try {
    require_once 'core/bootstrap.php';
    require_once 'core/router.class.php';

    require Router::load('app/routes.php')->direct(Request::uri());
} catch (NotFoundException $notFoundException) {
    die($notFoundException->getMessage());
}
