<?php if (!empty($errors)): ?>
<div class="max-w-2xl mx-auto mb-6">
    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
            <h3 class="text-red-800 font-semibold">Обнаружены ошибки:</h3>
        </div>
        <ul class="mt-2 ml-8 list-disc text-red-700">
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>