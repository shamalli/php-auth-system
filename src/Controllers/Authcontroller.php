<?php
namespace AuthSystem\Controllers;

use AuthSystem\Models\User;

class AuthController extends Controller {
    private User $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function register(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $success = '';
            
            $name = $this->sanitizeInput($_POST['name']);
            $email = $this->sanitizeInput($_POST['email']);
            $phone = $this->sanitizeInput($_POST['phone']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            
            if (empty($name) || empty($email) || empty($phone) || empty($password)) {
                $errors[] = "Все поля обязательны для заполнения";
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Некорректный формат email";
            }
            
            if ($password !== $confirm_password) {
                $errors[] = "Пароли не совпадают";
            }
            
            if (strlen($password) < 6) {
                $errors[] = "Пароль должен содержать минимум 6 символов";
            }
            
            if (empty($errors)) {
                $conflicts = $this->userModel->checkUniqueFields($email, $phone);
                
                if (in_array('email', $conflicts)) {
                    $errors[] = "Пользователь с таким email уже существует";
                }
                if (in_array('phone', $conflicts)) {
                    $errors[] = "Пользователь с таким телефоном уже существует";
                }
            }
            
            if (empty($errors)) {
                $user_id = $this->userModel->create($name, $email, $phone, $password);
                
                if ($user_id) {
                    $success = "Регистрация успешна! Теперь вы можете войти.";
                    $_POST = [];
                } else {
                    $errors[] = "Ошибка при регистрации";
                }
            }
            
            $this->view('auth/register', [
                'page_title' => "Регистрация",
                'errors' => $errors,
                'success' => $success,
                'post' => $_POST
            ]);
        } else {
            $this->view('auth/register', [
                'page_title' => "Регистрация",
                'errors' => [],
                'success' => '',
                'post' => []
            ]);
        }
    }
    
    public function login(): void {
        if ($this->isLoggedIn()) {
            $this->redirect('/profile');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            
            $login = $this->sanitizeInput($_POST['login']);
            $password = $_POST['password'];
            $captcha_token = $_POST['smart-token'] ?? '';
            
            if (empty($login) || empty($password)) {
                $errors[] = "Все поля обязательны для заполнения";
            }
            
            if (empty($captcha_token)) {
                $errors[] = "Пожалуйста, пройдите проверку капчи";
            }
            
            if (empty($errors) && !$this->verifyCaptcha($captcha_token)) {
                $errors[] = "Проверка капчи не пройдена";
            }
            
            if (empty($errors)) {
                $user = $this->userModel->findByEmailOrPhone($login);
                
                if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
                    $this->setSessionUser($user);
                    $this->redirect('/profile');
                } else {
                    $errors[] = "Неверный email/телефон или пароль";
                }
            }
            
            $this->view('auth/login', [
                'page_title' => "Авторизация",
                'errors' => $errors,
                'post' => $_POST
            ]);
        } else {
            $this->view('auth/login', [
                'page_title' => "Авторизация",
                'errors' => [],
                'post' => []
            ]);
        }
    }
    
    public function logout(): void {
        session_destroy();
        $this->redirect('/');
    }
}
?>