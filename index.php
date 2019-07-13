<?php


// настройки
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

define("ROOT",dirname(__FILE__));

include ROOT.'/application/config/config.php';

// файлы системы
include ROOT.'/application/core/db.php';
include ROOT.'/application/core/controller.php';
include ROOT.'/application/core/loader.php';
include ROOT.'/application/core/model.php';
include ROOT.'/application/core/view.php';
include ROOT.'/application/router.php';

// БД



//роутер
$router = new Router();
$router->run();





