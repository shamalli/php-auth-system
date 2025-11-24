<?php include app_dir() . 'Views/templates/header.php'; ?>
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="gradient-bg px-6 py-4">
            <h2 class="text-2xl font-bold text-white text-center">
                <i class="fas fa-user-cog mr-2"></i>Профиль пользователя
            </h2>
        </div>
        
        <div class="p-6">
            <?php include app_dir() . 'Views/templates/error.php'; ?>
            <?php include app_dir() . 'Views/templates/success.php'; ?>
            
            <form method="POST" action="" class="space-y-6">
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user mr-1 text-blue-500"></i>Имя
                        </label>
                        <input type="text" name="name" value="<?php echo $user['name']; ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-phone mr-1 text-blue-500"></i>Телефон
                        </label>
                        <input type="text" name="phone" value="<?php echo $user['phone']; ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-envelope mr-1 text-blue-500"></i>Email
                    </label>
                    <input type="email" name="email" value="<?php echo $user['email']; ?>" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                </div>
                
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-key mr-2 text-orange-500"></i>Смена пароля
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">Заполните только если хотите сменить пароль</p>
                    
                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Текущий пароль</label>
                            <input type="password" name="current_password" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Новый пароль</label>
                            <input type="password" name="new_password" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Повторите пароль</label>
                            <input type="password" name="confirm_password" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-between items-center pt-4">
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-150">
                        <i class="fas fa-save mr-2"></i>Сохранить изменения
                    </button>
                    
                    <a href="/logout" 
                       class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-150">
                        <i class="fas fa-sign-out-alt mr-2"></i>Выйти
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include app_dir() . 'Views/templates/footer.php'; ?>