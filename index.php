<?php
require __DIR__ . '/bootstrap.php';

use App\Core\Database\Database;
use App\Core\Http\Router;

Database::config('localhost', 'cadforn', 'root', '');

$router = new Router('http://localhost:8081/cadforn');

$router->get('/home', 'App\Controllers\HomeController@index');

$router->get('/empresa', 'App\Controllers\EmpresaController@list');

$router->run()->sendResponse();

// echo "<pre>";
// print_r($router);
// echo "</pre>";
// exit;