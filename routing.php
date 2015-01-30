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
    'etudiant' => array(
        'file' => 'Home/HomeController.php',
        'action' => 'etudiant'
    ),
    'enseignant' => array(
        'file' => 'Home/HomeController.php',
        'action' => 'enseignant'
    ),
    'parametres' => array(
        'file' => 'Home/HomeController.php',
        'action' => 'parametres'
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