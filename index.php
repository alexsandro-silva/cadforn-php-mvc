<?php
require __DIR__ . '/bootstrap.php';

use App\Core\Database\Database;
use App\Core\Environment;
use App\Core\Http\Router;

Environment::load(__DIR__);

Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT')
);

$router = new Router('http://localhost:8081/cadforn');

$router->get('/home', 'App\Controllers\HomeController@index');

$router->get('/empresa', 'App\Controllers\EmpresaController@list');
$router->get('/empresa/register', 'App\Controllers\EmpresaController@register');

$router->run()->sendResponse();

// echo "<pre>";
// print_r($router);
// echo "</pre>";
// exit;