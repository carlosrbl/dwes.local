<?php
    require_once __DIR__ . '/app.php';
    require_once __DIR__ . '/request.class.php';
    require_once __DIR__ . '../../src/exceptions/notFoundException.class.php';
    
    $config = require_once __DIR__ . '/../app/config.php';
    App::bind('config',$config); // Guardamos la configuración en el contenedor de servicios