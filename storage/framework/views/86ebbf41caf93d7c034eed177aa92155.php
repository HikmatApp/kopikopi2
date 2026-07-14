<?php $__env->startSection('page-title', 'Dashboard'); ?>
<?php $__env->startSection('page-subtitle', 'Selamat datang di Dashboard Admin KopiKopi'); ?>

<?php $__env->startSection('content'); ?>

<!-- HERO BANNER -->
<div class="bg-slate-700 rounded-2xl p-8 mb-6 text-white">
    <h2 class="text-2xl font-bold">Selamat Datang, <?php echo e(auth()->user()->name); ?> 👋</h2>
    <p class="text-slate-300 mt-2">Kelola seluruh aktivitas KopiKopi mulai dari mitra, stok barang, kas, hingga pemesanan.</p>
</div>

<!-- STAT CARDS -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
    <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Total Mitra','value' => $totalMitra,'icon' => '👥','iconBg' => 'bg-violet-100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Mitra','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($totalMitra),'icon' => '👥','iconBg' => 'bg-violet-100']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Total Barang','value' => $totalBarang,'icon' => '📦','iconBg' => 'bg-amber-100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Barang','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($totalBarang),'icon' => '📦','iconBg' => 'bg-amber-100']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Barang Menipis','value' => $barangMenipis,'icon' => '⚠️','iconBg' => 'bg-rose-100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Barang Menipis','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($barangMenipis),'icon' => '⚠️','iconBg' => 'bg-rose-100']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Pesanan Pending','value' => $pesananPending,'icon' => '🛒','iconBg' => 'bg-blue-100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Pesanan Pending','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pesananPending),'icon' => '🛒','iconBg' => 'bg-blue-100']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Saldo Kas','value' => 'Rp ' . number_format($saldoKas, 0, ',', '.'),'icon' => '💰','iconBg' => 'bg-green-100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Saldo Kas','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Rp ' . number_format($saldoKas, 0, ',', '.')),'icon' => '💰','iconBg' => 'bg-green-100']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- AKTIVITAS TERBARU -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-800 mb-4">📋 Aktivitas Terbaru</h3>

        <div class="space-y-4">
            <?php if($pesananPending > 0): ?>
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center shrink-0">🛒</div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Pesanan Baru</p>
                        <p class="text-gray-500 text-sm">Ada <?php echo e($pesananPending); ?> pesanan menunggu diproses.</p>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-gray-400 text-sm">Belum ada pesanan baru.</p>
            <?php endif; ?>

            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-full bg-green-100 flex items-center justify-center shrink-0">✅</div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm">Mitra Aktif</p>
                    <p class="text-gray-500 text-sm">Saat ini terdapat <?php echo e($totalMitra); ?> mitra terdaftar.</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-full <?php echo e($barangMenipis > 0 ? 'bg-rose-100' : 'bg-gray-100'); ?> flex items-center justify-center shrink-0">📦</div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm">Stok Barang</p>
                    <p class="text-gray-500 text-sm">Ada <?php echo e($barangMenipis); ?> barang perlu diperhatikan.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- RINGKASAN SISTEM -->
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-4">📈 Ringkasan Sistem</h3>
            <dl class="space-y-3 text-sm">
                <div class="flex justify-between"><dt class="text-gray-500">Total Mitra</dt><dd class="font-semibold text-gray-800"><?php echo e($totalMitra); ?></dd></div>
                <div class="flex justify-between"><dt class="text-gray-500">Total Barang</dt><dd class="font-semibold text-gray-800"><?php echo e($totalBarang); ?></dd></div>
                <div class="flex justify-between"><dt class="text-gray-500">Pesanan Pending</dt><dd class="font-semibold text-blue-600"><?php echo e($pesananPending); ?></dd></div>
                <div class="flex justify-between"><dt class="text-gray-500">Saldo Kas</dt><dd class="font-semibold <?php echo e($saldoKas >= 0 ? 'text-green-600' : 'text-red-600'); ?>">Rp <?php echo e(number_format($saldoKas, 0, ',', '.')); ?></dd></div>
            </dl>
        </div>

        <div class="bg-slate-700 rounded-2xl p-6 text-white">
            <h3 class="font-bold mb-1"><?php echo e($barangMenipis > 0 ? '⚠️ Perhatian' : '✅ Semua Normal'); ?></h3>
            <p class="text-slate-300 text-sm">
                <?php echo e($barangMenipis > 0 ? "Ada $barangMenipis barang yang stoknya menipis atau habis." : 'Semua sistem berjalan normal.'); ?>

            </p>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>