<?php
require_once __DIR__ . '/app.php';
require_once __DIR__ . '/request.class.php';
require_once __DIR__ . '../../src/exceptions/notFoundException.class.php';
require_once __DIR__ . '/router.class.php';
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/utils/myLog.php';


$config = require_once __DIR__ . '/../app/config.php';
App::bind('config', $config); // Guardamos la configuración en el contenedor de servicios

$router = Router::load('app/routes.php');
App::bind('router', $router);

$logger = MyLog::load('logs/curso.log');
App::bind('logger',$logger);