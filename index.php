<?php
require __DIR__ . '/bootstrap.php';

use App\Core\Http\Router;

$router = new Router('http://localhost:8081/cadforn');

$router->get('/home/:id', 'HomeController/index');

$router->run()->sendResponse();

// echo "<pre>";
// print_r($router);
// echo "</pre>";
// exit;