<?php $__env->startSection('page-title', 'Data Mitra'); ?>
<?php $__env->startSection('page-subtitle', 'Kelola semua mitra yang terdaftar dalam sistem'); ?>

<?php $__env->startSection('content'); ?>

<div class="flex justify-end mb-6">
    <a href="<?php echo e(route('admin.dashboard')); ?>"
       class="bg-gray-900 text-white px-5 py-2.5 rounded-xl shadow hover:bg-black transition text-sm font-medium">
        ← Dashboard
    </a>
</div>

<!-- STATISTIK -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
    <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Total Mitra','value' => $totalMitra ?? 0,'icon' => '👥','iconBg' => 'bg-gray-100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Mitra','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($totalMitra ?? 0),'icon' => '👥','iconBg' => 'bg-gray-100']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Mitra Aktif','value' => $mitraAktif ?? 0,'icon' => '✅','iconBg' => 'bg-green-100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Mitra Aktif','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mitraAktif ?? 0),'icon' => '✅','iconBg' => 'bg-green-100']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Mitra Baru Bulan Ini','value' => $mitraBaruBulanIni ?? 0,'icon' => '🆕','iconBg' => 'bg-blue-100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Mitra Baru Bulan Ini','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mitraBaruBulanIni ?? 0),'icon' => '🆕','iconBg' => 'bg-blue-100']); ?>
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

<!-- SEARCH -->
<form method="GET" action="<?php echo e(route('admin.mitra.index')); ?>" class="mb-5 flex gap-2">
    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama / email..."
        class="w-72 px-4 py-2.5 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm">
    <button type="submit" class="bg-gray-900 text-white px-4 py-2.5 rounded-xl hover:bg-black transition text-sm font-medium">Cari</button>
    <a href="<?php echo e(route('admin.mitra.index')); ?>" class="bg-gray-100 px-4 py-2.5 rounded-xl hover:bg-gray-200 transition text-sm font-medium">Reset</a>
</form>

<!-- TABLE CARD -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left text-sm">
        <thead class="bg-gray-900 text-white">
            <tr>
                <th class="p-4 font-semibold">No</th>
                <th class="p-4 font-semibold">Nama</th>
                <th class="p-4 font-semibold">Email</th>
                <th class="p-4 font-semibold">Status</th>
                <th class="p-4 font-semibold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $mitra; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50 transition">
                <td class="p-4 text-gray-500"><?php echo e($loop->iteration); ?></td>
                <td class="p-4 font-semibold text-gray-800"><?php echo e($item->name ?? $item->nama ?? '-'); ?></td>
                <td class="p-4 text-gray-600"><?php echo e($item->email ?? '-'); ?></td>
                <td class="p-4">
                    <?php if(($item->is_active ?? 0) == 1): ?>
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                    <?php else: ?>
                        <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">Non Aktif</span>
                    <?php endif; ?>
                </td>
                <td class="p-4">
                    <div class="flex gap-2 justify-center">
                        <a href="<?php echo e(route('admin.mitra.show', $item->id)); ?>"
                           class="bg-blue-500 text-white px-3 py-1.5 rounded-lg hover:bg-blue-600 transition text-xs font-medium">Detail</a>

                        <form action="<?php echo e(route('admin.mitra.toggle', $item->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <?php if($item->is_active): ?>
                                <button type="submit" class="bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 transition text-xs font-medium">Non Aktif</button>
                            <?php else: ?>
                                <button type="submit" class="bg-green-500 text-white px-3 py-1.5 rounded-lg hover:bg-green-600 transition text-xs font-medium">Aktif</button>
                            <?php endif; ?>
                        </form>

                        <form action="<?php echo e(route('admin.mitra.delete', $item->id)); ?>" method="POST"
                              onsubmit="return confirm('Yakin ingin hapus mitra ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="bg-gray-800 text-white px-3 py-1.5 rounded-lg hover:bg-black transition text-xs font-medium">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5" class="p-8 text-center text-gray-400">Tidak ada data mitra</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/admin/mitra/index.blade.php ENDPATH**/ ?>