<?php

use vendor\befew\Request;
use vendor\befew\Response;

$url = Request::getGet('page', 'index', true);

/* Add your routes here */
$routes = array(
    'index' => array(
        'file' => 'Home/HomeController.php',
        'action' => 'index'
    ),
    'student' => array(
        'file' => 'Home/HomeController.php',
        'action' => 'student'
    ),
    'teacher' => array(
        'file' => 'Home/HomeController.php',
        'action' => 'teacher'
    ),
    'parameters' => array(
        'file' => 'Home/HomeController.php',
        'action' => 'parameters'
    ),
    'disconnect' => array(
        'file' => 'Home/HomeController.php',
        'action' => 'disconnect'
    ),
);

$routeFound = false;
foreach($routes as $key => $path) {
    if(strpos($url, $key) === 0) {
        $page = substr($url, strlen($key) + 1);
        $class = 'src\\' . str_replace('/', '\\', substr($routes[$key]['file'], 0, strrpos($routes[$key]['file'], '.')));
        $object = new $class($url, $routes[$key]['action']);
        $routeFound = true;
        break;
    }
}

if($routeFound == false) {
    Response::throwStatus(404);
}