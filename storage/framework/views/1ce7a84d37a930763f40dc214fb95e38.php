<?php $__env->startSection('page-title', 'Laporan Pesanan Saya'); ?>
<?php $__env->startSection('page-subtitle', 'Riwayat pesanan stok yang pernah Anda buat'); ?>

<?php $__env->startSection('content'); ?>
<div class="print:bg-white">

    <div class="flex justify-end gap-3 mb-2 print:hidden">
        <button onclick="window.print()" class="bg-gray-900 hover:bg-black text-white px-4 py-2.5 rounded-xl text-sm font-medium transition">🖨️ Cetak</button>
        <a href="<?php echo e(route('laporan.export', request()->query())); ?>" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium transition">⬇️ Export Excel</a>
    </div>

    <p class="text-xs text-gray-400 mb-5 print:hidden">
        Laporan ini hanya menampilkan pesanan milik akun Anda sendiri. Anda tidak dapat melihat atau mengekspor data pesanan mitra lain.
    </p>

    <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-4 mb-5 print:hidden">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs text-gray-500 mb-1">Dari Tanggal</label>
                <input type="date" name="dari" value="<?php echo e($dari); ?>" class="border border-gray-200 rounded-xl px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Sampai Tanggal</label>
                <input type="date" name="sampai" value="<?php echo e($sampai); ?>" class="border border-gray-200 rounded-xl px-3 py-2 text-sm">
            </div>
            <button type="submit" class="bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-xl text-sm transition">Filter</button>
            <a href="<?php echo e(route('laporan.index')); ?>" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm transition">Reset</a>
        </form>
    </div>

    <div class="hidden print:block text-center mb-6">
        <h1 class="text-xl font-bold">Laporan Pesanan - <?php echo e(auth()->user()->name); ?></h1>
        <p class="text-sm">Periode: <?php echo e($dari ?: 'Semua'); ?> s/d <?php echo e($sampai ?: 'Semua'); ?></p>
    </div>

    <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden print:border print:shadow-none">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-4 font-semibold">Tanggal</th>
                    <th class="p-4 font-semibold">Barang</th>
                    <th class="p-4 font-semibold">Jumlah</th>
                    <th class="p-4 font-semibold">Status</th>
                    <th class="p-4 font-semibold">Catatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $pemesanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="p-4 text-gray-600"><?php echo e($p->created_at->format('d M Y H:i')); ?></td>
                    <td class="p-4 text-gray-700"><?php echo e($p->barang->nama_barang ?? '-'); ?></td>
                    <td class="p-4 text-gray-600"><?php echo e($p->jumlah); ?></td>
                    <td class="p-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium <?php echo e($p->status_badge); ?>"><?php echo e(ucfirst($p->status)); ?></span></td>
                    <td class="p-4 text-gray-500"><?php echo e($p->catatan ?? '-'); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="p-8 text-center text-gray-400">Belum ada pesanan pada periode ini</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/laporan/mitra.blade.php ENDPATH**/ ?>