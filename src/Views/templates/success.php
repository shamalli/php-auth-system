<?php if (!empty($success)): ?>
<div class="max-w-2xl mx-auto mb-6">
    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <span class="text-green-800 font-semibold"><?php echo $success; ?></span>
        </div>
    </div>
</div>
<?php endif; ?>