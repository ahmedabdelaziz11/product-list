<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'scandiweb\app' . DIRECTORY_SEPARATOR);

require_once APP . 'config/config.php';

if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
}

$router = new App\core\router();

$router->get('', 'ProductListController@index');
$router->get('about', 'PageController@about');
$router->post('contact', 'ContactController@submit');

$router->dispatch();