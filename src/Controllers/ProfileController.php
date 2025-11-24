<?php
namespace AuthSystem\Controllers;

use AuthSystem\Models\User;

class ProfileController extends Controller {
    private User $userModel;
    
    public function __construct() {
        if (!$this->isLoggedIn()) {
            $this->redirect('/login');
        }
        $this->userModel = new User();
    }
    
    public function index(): void {
        $user = $this->userModel->findById($_SESSION['user_id']);
        $errors = [];
        $success = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $this->sanitizeInput($_POST['name']);
            $email = $this->sanitizeInput($_POST['email']);
            $phone = $this->sanitizeInput($_POST['phone']);
            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            
            if (empty($name) || empty($email) || empty($phone)) {
                $errors[] = "Имя, email и телефон обязательны для заполнения";
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Некорректный формат email";
            }
            
            $change_password = !empty($new_password);
            if ($change_password) {
                if ($new_password !== $confirm_password) {
                    $errors[] = "Новые пароли не совпадают";
                }
                
                if (strlen($new_password) < 6) {
                    $errors[] = "Пароль должен содержать минимум 6 символов";
                }
                
                $current_user = $this->userModel->findByEmailOrPhone($_SESSION['user_email']);
                if (!$this->userModel->verifyPassword($current_password, $current_user['password'])) {
                    $errors[] = "Текущий пароль неверен";
                }
            }
            
            if (empty($errors)) {
                $conflicts = $this->userModel->checkUniqueFields($email, $phone, $_SESSION['user_id']);
                
                if (in_array('email', $conflicts)) {
                    $errors[] = "Пользователь с таким email уже существует";
                }
                if (in_array('phone', $conflicts)) {
                    $errors[] = "Пользователь с таким телефоном уже существует";
                }
            }
            
            if (empty($errors)) {
                $result = $this->userModel->update(
                    $_SESSION['user_id'], 
                    $name, 
                    $email, 
                    $phone, 
                    $change_password ? $new_password : null
                );
                
                if ($result) {
                    $this->setSessionUser([
                        'id' => $_SESSION['user_id'],
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone
                    ]);
                    $success = "Данные успешно обновлены!";
                    $user = ['name' => $name, 'email' => $email, 'phone' => $phone];
                } else {
                    $errors[] = "Ошибка при обновлении данных";
                }
            }
        }
        
        $this->view('profile/index', [
            'page_title' => "Профиль",
            'user' => $user,
            'errors' => $errors,
            'success' => $success
        ]);
    }
}
?>