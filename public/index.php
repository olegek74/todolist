<?php

define('DS', DIRECTORY_SEPARATOR);

define('ROOTPATH', dirname(__DIR__));

session_start();

require_once ROOTPATH.DS.'vendor'.DS.'autoload.php';
$route = new \App\Router;

$controller = $route->controller;

$controller = new $controller;
$task = $route->task;
$controller->$task();
?>