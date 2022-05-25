<?php

define('DS', DIRECTORY_SEPARATOR);

define('ROOTPATH', dirname(__DIR__));

session_start();

require_once ROOTPATH.DS.'vendor'.DS.'autoload.php';
$route = \App\Router::instance();

$controllerName = $route->controller;

if(!class_exists($controllerName)){
    $controller = new \App\Controller;
    $controller->not_page();
    die;
}

$controller = $controllerName::instance();
$task = $route->task;
$controller->$task();
/*var_dump(array_keys(\App\Objects::$objects));*/
?>