<?php include app_dir() . 'Views/templates/header.php'; ?>
<div class="max-w-4xl mx-auto text-center">
    <div class="gradient-bg rounded-2xl p-12 text-white mb-8">
        <h1 class="text-4xl font-bold mb-4">Добро пожаловать в AuthSystem</h1>
        <p class="text-xl opacity-90">Безопасная система аутентификации и управления профилем</p>
    </div>
    
    <div class="grid md:grid-cols-3 gap-8 mt-12">
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4 mx-auto">
                <i class="fas fa-shield-alt text-blue-600 text-xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Безопасность</h3>
            <p class="text-gray-600">Хеширование паролей и защита от SQL-инъекций</p>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4 mx-auto">
                <i class="fas fa-user-cog text-green-600 text-xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Управление</h3>
            <p class="text-gray-600">Полный контроль над вашим профилем и данными</p>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4 mx-auto">
                <i class="fas fa-robot text-purple-600 text-xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Капча</h3>
            <p class="text-gray-600">Защита от ботов с Yandex SmartCaptcha</p>
        </div>
    </div>
    
    <?php if (!isset($_SESSION['user_id'])): ?>
    <div class="mt-12 bg-white rounded-xl shadow-lg p-8 border border-gray-100">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Начните работу</h2>
        <p class="text-gray-600 mb-6">Зарегистрируйтесь или войдите в систему</p>
        <div class="flex justify-center space-x-4">
            <a href="/register" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-150">
                <i class="fas fa-user-plus mr-2"></i>Регистрация
            </a>
            <a href="/login" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-150">
                <i class="fas fa-sign-in-alt mr-2"></i>Войти
            </a>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php include app_dir() . 'Views/templates/footer.php'; ?>