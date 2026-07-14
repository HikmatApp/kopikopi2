<?php
    $isAdmin = auth()->user()->isAdmin();
    $barangMenipis = \App\Models\StokBarang::get()->filter(fn($b) => $b->status !== 'Aman')->count();
    $pesananPending = \App\Models\Pemesanan::where('status', 'pending')->count();
?>
<header class="bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between gap-4">

    <div class="min-w-0">
        <h1 class="text-xl font-bold text-gray-800 truncate"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
        <p class="text-sm text-gray-400 truncate"><?php echo $__env->yieldContent('page-subtitle', ''); ?></p>
    </div>

    <div class="flex items-center gap-3 shrink-0">

        <?php if($isAdmin && $barangMenipis > 0): ?>
            <a href="<?php echo e(route('admin.stok.index')); ?>"
                class="relative hidden sm:inline-flex items-center gap-1 bg-amber-50 text-amber-700 text-xs font-medium px-3 py-2 rounded-full hover:bg-amber-100 transition">
                🔔 <?php echo e($barangMenipis); ?> barang menipis
            </a>
        <?php endif; ?>

        <?php if($isAdmin && $pesananPending > 0): ?>
            <a href="<?php echo e(route('pemesanan.index')); ?>"
                class="relative hidden sm:inline-flex items-center gap-1 bg-blue-50 text-blue-700 text-xs font-medium px-3 py-2 rounded-full hover:bg-blue-100 transition">
                🛒 <?php echo e($pesananPending); ?> pesanan baru
            </a>
        <?php endif; ?>

        <div class="flex items-center gap-2 pl-3 border-l border-gray-100">
            <div class="w-9 h-9 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-sm">
                <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

            </div>
            <div class="hidden sm:block text-sm">
                <p class="text-gray-400 text-xs leading-tight">Selamat Datang 👋</p>
                <p class="font-semibold text-gray-800 leading-tight"><?php echo e(auth()->user()->name); ?></p>
            </div>
        </div>
    </div>
</header>
<?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/layouts/partials/topbar.blade.php ENDPATH**/ ?>