<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'scandiweb/app' . DIRECTORY_SEPARATOR);

require_once APP . 'config/config.php';

if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
}

$router = new App\core\router();

$router->get('', 'ProductController@index');
$router->get('add-product/', 'ProductController@create');

$router->get('products', 'ProductController@list');
$router->post('products/delete', 'ProductController@delete');
$router->post('products/store', 'ProductController@store');

$router->dispatch();