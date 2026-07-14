<?php
    $isAdmin = auth()->user()->isAdmin();
    $barangMenipis = $isAdmin ? \App\Models\StokBarang::get()->filter(fn($b) => $b->status !== 'Aman')->count() : 0;

    // Palet: admin pakai sidebar terang + aksen oranye, mitra pakai sidebar gelap slate.
    $sidebarBg   = $isAdmin ? 'bg-white border-r border-gray-100' : 'bg-slate-800';
    $textNormal  = $isAdmin ? 'text-gray-600' : 'text-slate-300';
    $textMuted   = $isAdmin ? 'text-gray-400' : 'text-slate-400';
    $hoverBg     = $isAdmin ? 'hover:bg-gray-50' : 'hover:bg-slate-700/60';
    $activeBg    = $isAdmin ? 'bg-orange-500 text-white shadow-sm' : 'bg-orange-500 text-white shadow-sm';
?>
<aside class="w-64 shrink-0 <?php echo e($sidebarBg); ?> flex flex-col h-screen sticky top-0 overflow-y-auto">

    <!-- LOGO -->
    <div class="px-6 py-6">
        <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-2">
            <span class="text-2xl">☕</span>
            <span class="text-xl font-extrabold <?php echo e($isAdmin ? 'text-orange-600' : 'text-white'); ?>">KopiKopi</span>
        </a>
        <p class="text-xs <?php echo e($textMuted); ?> mt-1 ml-9">Coffee Management System</p>

        <?php if($isAdmin): ?>
            <span class="inline-block mt-3 text-[11px] font-semibold tracking-wide text-orange-600 bg-orange-100 px-3 py-1 rounded-full">
                ADMIN PANEL
            </span>
        <?php else: ?>
            <span class="inline-block mt-3 text-[11px] font-semibold tracking-wide text-orange-300 bg-slate-700 px-3 py-1 rounded-full">
                MITRA PANEL
            </span>
        <?php endif; ?>
    </div>

    <div class="border-t <?php echo e($isAdmin ? 'border-gray-100' : 'border-slate-700'); ?>"></div>

    <!-- MENU -->
    <nav class="flex-1 px-4 py-4 space-y-1">
        <?php if($isAdmin): ?>
            <?php
                $menu = [
                    ['route' => 'admin.dashboard', 'is' => 'admin.dashboard', 'icon' => '📊', 'label' => 'Dashboard'],
                    ['route' => 'admin.mitra.index', 'is' => 'admin.mitra.*', 'icon' => '👥', 'label' => 'Data Mitra'],
                    ['route' => 'admin.stok.index', 'is' => 'admin.stok.*', 'icon' => '📦', 'label' => 'Stok Barang'],
                    ['route' => 'pemesanan.index', 'is' => 'pemesanan.*', 'icon' => '🧾', 'label' => 'Pemesanan'],
                    ['route' => 'admin.kas.index', 'params' => 'masuk', 'is' => 'admin.kas.*', 'icon' => '💳', 'label' => 'Kas / Transaksi'],
                    ['route' => 'laporan.index', 'is' => 'laporan.*', 'icon' => '📈', 'label' => 'Laporan'],
                    ['route' => 'admin.user.index', 'is' => 'admin.user.*', 'icon' => '🛡️', 'label' => 'Kelola User'],
                ];
            ?>
            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $active = request()->routeIs($m['is']); ?>
                <a href="<?php echo e(isset($m['params']) ? route($m['route'], $m['params']) : route($m['route'])); ?>"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                        <?php echo e($active ? $activeBg : $textNormal . ' ' . $hoverBg); ?>">
                    <span class="text-lg"><?php echo e($m['icon']); ?></span>
                    <?php echo e($m['label']); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="pt-3 mt-3 border-t <?php echo e($isAdmin ? 'border-gray-100' : 'border-slate-700'); ?>">
                <p class="px-4 text-[11px] uppercase tracking-wide <?php echo e($textMuted); ?> mb-1">Pengaturan</p>
                <?php $active = request()->routeIs('pengaturan.*'); ?>
                <a href="<?php echo e(route('pengaturan.edit')); ?>"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                        <?php echo e($active ? $activeBg : $textNormal . ' ' . $hoverBg); ?>">
                    <span class="text-lg">⚙️</span> Profile &amp; Keamanan
                </a>
            </div>
        <?php else: ?>
            <?php
                $menu = [
                    ['route' => 'mitra.dashboard', 'is' => 'mitra.dashboard', 'icon' => '📊', 'label' => 'Dashboard'],
                    ['route' => 'mitra.stok', 'is' => 'mitra.stok', 'icon' => '📦', 'label' => 'Katalog Stok'],
                    ['route' => 'pemesanan.index', 'is' => 'pemesanan.*', 'icon' => '🛒', 'label' => 'Pesanan Saya'],
                    ['route' => 'laporan.index', 'is' => 'laporan.*', 'icon' => '📈', 'label' => 'Laporan Saya'],
                    ['route' => 'pengaturan.edit', 'is' => 'pengaturan.*', 'icon' => '⚙️', 'label' => 'Pengaturan'],
                ];
            ?>
            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $active = request()->routeIs($m['is']); ?>
                <a href="<?php echo e(route($m['route'])); ?>"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                        <?php echo e($active ? $activeBg : $textNormal . ' ' . $hoverBg); ?>">
                    <span class="text-lg"><?php echo e($m['icon']); ?></span>
                    <?php echo e($m['label']); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </nav>

    <!-- USER FOOTER -->
    <div class="px-4 py-4 border-t <?php echo e($isAdmin ? 'border-gray-100' : 'border-slate-700'); ?>">
        <div class="flex items-center gap-3 px-2 mb-3">
            <div class="w-9 h-9 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold">
                <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

            </div>
            <div class="min-w-0">
                <p class="text-sm font-semibold truncate <?php echo e($isAdmin ? 'text-gray-800' : 'text-white'); ?>"><?php echo e(auth()->user()->name); ?></p>
                <p class="text-xs <?php echo e($textMuted); ?>"><?php echo e($isAdmin ? 'Administrator' : 'Mitra KopiKopi'); ?></p>
            </div>
        </div>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold py-2.5 rounded-xl transition">
                🚪 Logout
            </button>
        </form>
    </div>
</aside>
<?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/layouts/partials/sidebar.blade.php ENDPATH**/ ?>