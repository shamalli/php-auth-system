<?php
namespace AuthSystem\Config;

class Config {
    const DB_HOST = 'db';
    const DB_USER = 'root';
    const DB_PASS = 'root';
    const DB_NAME = 'users';
    
    const CAPTCHA_CLIENT_KEY = '';
    const CAPTCHA_SERVER_KEY = '';
    
    public static function init() {
        session_start();
        
        // Автозагрузка классов через Composer
        require_once __DIR__ . '/../../vendor/autoload.php';
    }
}
?>