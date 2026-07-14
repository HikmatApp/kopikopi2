<?php $__env->startSection('page-title', 'Dashboard Mitra'); ?>
<?php $__env->startSection('page-subtitle', 'Selamat datang di Dashboard Mitra KopiKopi'); ?>

<?php $__env->startSection('content'); ?>

<!-- HERO BANNER -->
<div class="bg-orange-500 rounded-2xl p-8 mb-6 text-white">
    <h2 class="text-2xl font-bold">
        Selamat Datang, <?php echo e(auth()->user()->name); ?> 👋
    </h2>

    <p class="text-orange-100 mt-2">
        Kelola aktivitas Anda mulai dari memesan stok hingga melihat riwayat pesanan.
    </p>
</div>

<!-- STAT CARDS -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
    <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Total Pesanan Saya','value' => $totalPesanan,'icon' => '🧾','iconBg' => 'bg-blue-100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Pesanan Saya','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($totalPesanan),'icon' => '🧾','iconBg' => 'bg-blue-100']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Menunggu Diproses','value' => $pesananPending,'icon' => '⏳','iconBg' => 'bg-amber-100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Menunggu Diproses','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pesananPending),'icon' => '⏳','iconBg' => 'bg-amber-100']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Selesai','value' => $pesananSelesai,'icon' => '✅','iconBg' => 'bg-green-100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Selesai','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pesananSelesai),'icon' => '✅','iconBg' => 'bg-green-100']); ?>
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

<!-- MENU CEPAT -->
<div class="mb-6">

    <h3 class="font-bold text-gray-800 mb-3">
        ⚡ Menu Cepat
    </h3>

    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">

        <!-- PESAN STOK -->
        <a href="<?php echo e(route('mitra.stok')); ?>"
           class="bg-white hover:shadow-md rounded-2xl border border-gray-100 p-5 text-center transition">

            <div class="text-2xl mb-2">
                🛒
            </div>

            <p class="text-sm font-semibold text-gray-700">
                Pesan Stok
            </p>

        </a>

        <!-- KATALOG STOK -->
        <a href="<?php echo e(route('mitra.stok')); ?>"
           class="bg-white hover:shadow-md rounded-2xl border border-gray-100 p-5 text-center transition">

            <div class="text-2xl mb-2">
                📦
            </div>

            <p class="text-sm font-semibold text-gray-700">
                Katalog Stok
            </p>

        </a>

        <!-- LAPORAN -->
        <a href="<?php echo e(route('laporan.index')); ?>"
           class="bg-white hover:shadow-md rounded-2xl border border-gray-100 p-5 text-center transition">

            <div class="text-2xl mb-2">
                📈
            </div>

            <p class="text-sm font-semibold text-gray-700">
                Laporan Saya
            </p>

        </a>

    </div>

</div>

<!-- PESANAN TERBARU -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">

        <h3 class="font-bold text-gray-800">
            📋 Pesanan Terbaru
        </h3>

        <a href="<?php echo e(route('pemesanan.index')); ?>"
           class="text-sm text-orange-600 hover:underline font-medium">

            Lihat semua →

        </a>

    </div>

    <?php if($pesananTerbaru->isEmpty()): ?>

        <p class="p-6 text-gray-400 text-sm">
            Belum ada pesanan. Yuk mulai pesan stok pertama Anda.
        </p>

    <?php else: ?>

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-500 text-left">
                <tr>
                    <th class="px-6 py-3 font-semibold">
                        Barang
                    </th>

                    <th class="px-6 py-3 font-semibold">
                        Jumlah
                    </th>

                    <th class="px-6 py-3 font-semibold">
                        Status
                    </th>

                    <th class="px-6 py-3 font-semibold">
                        Tanggal
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

                <?php $__currentLoopData = $pesananTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>

                        <td class="px-6 py-3 font-medium text-gray-700">
                            <?php echo e($p->barang->nama_barang ?? '-'); ?>

                        </td>

                        <td class="px-6 py-3">
                            <?php echo e($p->jumlah); ?>

                        </td>

                        <td class="px-6 py-3">
                            <span class="px-2 py-1 rounded-full text-xs <?php echo e($p->status_badge); ?>">
                                <?php echo e(ucfirst($p->status)); ?>

                            </span>
                        </td>

                        <td class="px-6 py-3 text-gray-500">
                            <?php echo e($p->created_at->format('d M Y')); ?>

                        </td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/mitra/dashboard.blade.php ENDPATH**/ ?>