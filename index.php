<?php
require 'vendor/autoload.php';
require 'functions.php';

use AuthSystem\Config\Config;
use AuthSystem\Controllers\HomeController;
use AuthSystem\Controllers\AuthController;
use AuthSystem\Controllers\ProfileController;

// Инициализация конфигурации
Config::init();

$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

switch ($path) {
    case '/':
    case '':
        $controller = new HomeController();
        $controller->index();
        break;
        
    case '/register':
        $controller = new AuthController();
        $controller->register();
        break;
        
    case '/login':
        $controller = new AuthController();
        $controller->login();
        break;
        
    case '/logout':
        $controller = new AuthController();
        $controller->logout();
        break;
        
    case '/profile':
        $controller = new ProfileController();
        $controller->index();
        break;
        
    default:
        http_response_code(404);
        echo "Страница не найдена";
        break;
}
?>