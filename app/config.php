<?php
global $DBH;

define('DEBUG', true);
define('CACHE_TWIG', 'cache' . DIRECTORY_SEPARATOR . 'twig');
define('STYLES_FOLDER', 'styles');
define('TEMPLATES_FOLDER', 'templates');
define('SCRIPTS_FOLDER', 'scripts');

if(DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} else {
    error_reporting(E_STRICT);
    ini_set('display_errors', 0);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
}
