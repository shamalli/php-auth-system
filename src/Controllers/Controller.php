<?php
namespace AuthSystem\Controllers;

use AuthSystem\Config\Config;

abstract class Controller {
    protected function view(string $view, array $data = []): void {
        extract($data);
        require __DIR__ . "/../Views/{$view}.php";
    }
    
    protected function redirect(string $url): void {
        header("Location: $url");
        exit;
    }
    
    protected function isLoggedIn(): bool {
        return isset($_SESSION['user_id']);
    }
    
    protected function sanitizeInput(string $data): string {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
    
    protected function setSessionUser(array $user): void {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_phone'] = $user['phone'];
    }
    
    protected function verifyCaptcha(string $token): bool {
        if (empty(Config::CAPTCHA_SERVER_KEY)) {
            return true;
        }
        
        $captcha_url = "https://smartcaptcha.yandexcloud.net/validate";
        $captcha_data = [
            'secret' => Config::CAPTCHA_SERVER_KEY,
            'token' => $token,
            'ip' => $_SERVER['REMOTE_ADDR']
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $captcha_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($captcha_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        
        $captcha_response = curl_exec($ch);
        curl_close($ch);
        
        $captcha_result = json_decode($captcha_response, true);
        return $captcha_result['status'] === 'ok';
    }
}
?>