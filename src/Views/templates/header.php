<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'AuthSystem'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-user-shield text-blue-600 text-2xl"></i>
                    <a href="/" class="text-xl font-bold text-gray-800 hover:text-blue-600 transition duration-150">AuthSystem</a>
                </div>
                <div class="flex items-center space-x-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <span class="text-gray-700">Привет, <strong><?php echo $_SESSION['user_name']; ?></strong>!</span>
                        <a href="/profile" class="text-blue-600 hover:text-blue-800 transition duration-150">
                            <i class="fas fa-user mr-1"></i>Профиль
                        </a>
                        <a href="/logout" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-150">
                            <i class="fas fa-sign-out-alt mr-1"></i>Выйти
                        </a>
                    <?php else: ?>
                        <a href="/login" class="text-blue-600 hover:text-blue-800 transition duration-150">
                            <i class="fas fa-sign-in-alt mr-1"></i>Войти
                        </a>
                        <a href="/register" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-150">
                            <i class="fas fa-user-plus mr-1"></i>Регистрация
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    
    <main class="container mx-auto px-4 py-8">