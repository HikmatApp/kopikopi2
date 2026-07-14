<?php $__env->startSection('page-title', 'Laporan'); ?>
<?php $__env->startSection('page-subtitle', 'Laporan arus kas & pergerakan stok UMKM KopiKopi'); ?>

<?php $__env->startSection('content'); ?>
<div class="print:bg-white">

    <div class="flex justify-end gap-3 mb-5 print:hidden">
        <button onclick="window.print()" class="bg-gray-900 hover:bg-black text-white px-4 py-2.5 rounded-xl text-sm font-medium transition">🖨️ Cetak</button>
        <a href="<?php echo e(route('laporan.export', request()->query())); ?>" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium transition">⬇️ Export Excel</a>
    </div>

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
        <h1 class="text-xl font-bold">Laporan UMKM KopiKopi</h1>
        <p class="text-sm">Periode: <?php echo e($dari ?: 'Semua'); ?> s/d <?php echo e($sampai ?: 'Semua'); ?></p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
        <div class="bg-green-50 border border-green-100 rounded-2xl p-5">
            <p class="text-sm text-green-700">Total Cash In</p>
            <h2 class="text-2xl font-bold text-green-600 mt-1">Rp <?php echo e(number_format($totalMasuk, 0, ',', '.')); ?></h2>
        </div>
        <div class="bg-red-50 border border-red-100 rounded-2xl p-5">
            <p class="text-sm text-red-700">Total Cash Out</p>
            <h2 class="text-2xl font-bold text-red-600 mt-1">Rp <?php echo e(number_format($totalKeluar, 0, ',', '.')); ?></h2>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-5">
            <p class="text-sm text-gray-500">Saldo</p>
            <h2 class="text-2xl font-bold <?php echo e($saldo >= 0 ? 'text-gray-800' : 'text-red-600'); ?> mt-1">Rp <?php echo e(number_format($saldo, 0, ',', '.')); ?></h2>
        </div>
    </div>

    <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden mb-6 print:border print:shadow-none">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-800">Riwayat Transaksi Kas</h3>
            <p class="text-sm text-gray-400">Seluruh transaksi Cash In dan Cash Out.</p>
        </div>
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-4 font-semibold">Tanggal</th>
                    <th class="p-4 font-semibold">Jenis</th>
                    <th class="p-4 font-semibold">Keterangan</th>
                    <th class="p-4 font-semibold">Nominal</th>
                    <th class="p-4 font-semibold">Dicatat Oleh</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $kas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="p-4 text-gray-600"><?php echo e($k->tanggal->format('d M Y')); ?></td>
                    <td class="p-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium <?php echo e($k->jenis == 'masuk' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'); ?>"><?php echo e(ucfirst($k->jenis)); ?></span>
                    </td>
                    <td class="p-4 text-gray-700"><?php echo e($k->keterangan); ?></td>
                    <td class="p-4 font-medium text-gray-800"><?php echo e($k->nominal_format); ?></td>
                    <td class="p-4 text-gray-500"><?php echo e($k->user->name ?? '-'); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="p-8 text-center text-gray-400">Tidak ada transaksi pada periode ini</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden print:border print:shadow-none">
        <div class="px-6 py-4 border-b border-gray-100"><h3 class="font-bold text-gray-800">Riwayat Pergerakan Stok</h3></div>
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-4 font-semibold">Tanggal</th>
                    <th class="p-4 font-semibold">Barang</th>
                    <th class="p-4 font-semibold">Jenis</th>
                    <th class="p-4 font-semibold">Jumlah</th>
                    <th class="p-4 font-semibold">Oleh</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $riwayatStok; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="p-4 text-gray-600"><?php echo e($r->created_at->format('d M Y')); ?></td>
                    <td class="p-4 text-gray-700"><?php echo e($r->barang->nama_barang ?? '-'); ?></td>
                    <td class="p-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium <?php echo e($r->jenis == 'masuk' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'); ?>"><?php echo e(ucfirst($r->jenis)); ?></span>
                    </td>
                    <td class="p-4 text-gray-600"><?php echo e($r->jumlah); ?></td>
                    <td class="p-4 text-gray-500"><?php echo e($r->user->name ?? '-'); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="p-8 text-center text-gray-400">Tidak ada pergerakan stok pada periode ini</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/laporan/admin.blade.php ENDPATH**/ ?>