<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;
use App\Controllers\UserController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\BlogController;
use App\Middleware\AuthMiddleware;

// Router instance'ı oluştur
$router = new Router();

// Ana sayfa route'u
$router->add('/', [HomeController::class, 'index']);

// Auth route'ları
$router->add('/login', [AuthController::class, 'login']);
$router->add('/logout', [AuthController::class, 'logout']);

// User route'ları
$router->add('/user/{\d+}', [UserController::class, 'show']); // Sadece sayısal ID'ler
$router->add('/user/{id}', [UserController::class, 'show'], [AuthMiddleware::class]);
$router->add('/user/{id?}', [UserController::class, 'show']);

// Blog route'ları
$router->add('/blog/{id}', [BlogController::class, 'show']);
$router->add('/blog/{id}/translations/{language_id}', [BlogController::class, 'translations']);

// URI'yi al
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

try {
    // Route'u çalıştır
    $response = $router->dispatch($uri);
    
    // Response tipine göre header'ı ayarla
    if (is_array($response) || is_object($response)) {
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        header('Content-Type: text/html; charset=utf-8');
        echo $response;
    }
} catch (Exception $e) {
    header('HTTP/1.1 404 Not Found');
    echo '404 - Sayfa Bulunamadı';
} 