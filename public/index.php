<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use App\libs\HttpRequest;
use App\Router;
use Controllers\HomeController;
use Controllers\AuthController;
use Controllers\ContactosController;

$request = new HttpRequest();
$router = new Router($request);
$id =$router->getUrlParam(1);
$router->add('/', [HomeController::class, 'index']);
$router->add('/api/auth/signup', [AuthController::class, 'signup'], 'POST');
$router->add('/api/auth/signin', [AuthController::class, 'signin'], 'POST');
$router->add("/api/contactos/{$id}", [ContactosController::class, 'find']);
$router->add('/api/contactos', [ContactosController::class, 'create'], 'POST');
$router->add("/api/contactos/{$id}", [ContactosController::class, 'update'], 'PATCH');

$router->run();
