<?php include app_dir() . 'Views/templates/header.php'; ?>
<div class="max-w-md mx-auto bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
    <div class="gradient-bg px-6 py-4">
        <h2 class="text-2xl font-bold text-white text-center">
            <i class="fas fa-user-plus mr-2"></i>Регистрация
        </h2>
    </div>
    
    <div class="p-6">
        <?php include app_dir() . 'Views/templates/error.php'; ?>
        <?php include app_dir() . 'Views/templates/success.php'; ?>
        
        <form method="POST" action="" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-user mr-1 text-blue-500"></i>Имя
                </label>
                <input type="text" name="name" value="<?php echo $post['name'] ?? ''; ?>" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-envelope mr-1 text-blue-500"></i>Email
                </label>
                <input type="email" name="email" value="<?php echo $post['email'] ?? ''; ?>" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-phone mr-1 text-blue-500"></i>Телефон
                </label>
                <input type="text" name="phone" value="<?php echo $post['phone'] ?? ''; ?>" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-lock mr-1 text-blue-500"></i>Пароль
                </label>
                <input type="password" name="password" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-lock mr-1 text-blue-500"></i>Повторите пароль
                </label>
                <input type="password" name="confirm_password" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       required>
            </div>
            
            <button type="submit" 
                    class="w-full gradient-bg text-white py-3 rounded-lg font-semibold hover:opacity-90 transition duration-150">
                <i class="fas fa-user-plus mr-2"></i>Зарегистрироваться
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-gray-600">Уже есть аккаунт? 
                <a href="/login" class="text-blue-500 hover:text-blue-700 font-semibold">
                    <i class="fas fa-sign-in-alt mr-1"></i>Войти
                </a>
            </p>
        </div>
    </div>
</div>
<?php include app_dir() . 'Views/templates/footer.php'; ?>