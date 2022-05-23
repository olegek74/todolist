<?php

define('DS', DIRECTORY_SEPARATOR);

define('ROOTPATH', dirname(__DIR__));

session_start();

require_once ROOTPATH.DS.'vendor'.DS.'autoload.php';
$route = \App\Router::instance();

$controllerName = $route->controller;

$controller = $controllerName::instance();
$task = $route->task;
$controller->$task();
?>