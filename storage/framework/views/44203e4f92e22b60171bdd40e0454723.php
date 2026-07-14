<?php $__env->startSection('page-title', 'Dashboard Keuangan'); ?>
<?php $__env->startSection('page-subtitle', 'Monitoring pemasukan, pengeluaran dan saldo UMKM KopiKopi'); ?>

<?php $__env->startSection('content'); ?>

<div class="space-y-6">

    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex flex-col md:flex-row justify-between md:items-center gap-4">

        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Dashboard Keuangan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Semua transaksi kas masuk dan kas keluar ditampilkan dalam satu halaman.
            </p>
        </div>

        <div class="flex gap-3">

            <a href="<?php echo e(route('admin.dashboard')); ?>"
                class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium transition">
                ← Kembali
            </a>

            <a href="<?php echo e(route('admin.kas.create','masuk')); ?>"
                class="px-5 py-2.5 rounded-xl bg-green-500 hover:bg-green-600 text-white font-semibold transition">
                + Kas Masuk
            </a>

            <a href="<?php echo e(route('admin.kas.create','keluar')); ?>"
                class="px-5 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white font-semibold transition">
                + Kas Keluar
            </a>

        </div>

    </div>


    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        
        <div class="bg-green-50 border border-green-200 rounded-2xl p-6">

            <p class="text-sm text-green-700">
                Total Kas Masuk
            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">
                Rp <?php echo e(number_format($totalKasMasuk,0,',','.')); ?>

            </h2>

            <p class="text-xs text-green-600 mt-2">
                Total seluruh pemasukan.
            </p>

        </div>


        
        <div class="bg-red-50 border border-red-200 rounded-2xl p-6">

            <p class="text-sm text-red-700">
                Total Kas Keluar
            </p>

            <h2 class="text-3xl font-bold text-red-600 mt-2">
                Rp <?php echo e(number_format($totalKasKeluar,0,',','.')); ?>

            </h2>

            <p class="text-xs text-red-600 mt-2">
                Total seluruh pengeluaran.
            </p>

        </div>


        
        <div class="rounded-2xl p-6 border
            <?php if($saldoKas >= 0): ?>
                bg-blue-50 border-blue-200
            <?php else: ?>
                bg-yellow-50 border-yellow-200
            <?php endif; ?>">

            <p class="text-sm text-gray-600">
                Saldo Saat Ini
            </p>

            <h2 class="text-3xl font-bold
                <?php if($saldoKas >= 0): ?>
                    text-blue-600
                <?php else: ?>
                    text-red-600
                <?php endif; ?>">

                Rp <?php echo e(number_format($saldoKas,0,',','.')); ?>


            </h2>

            <?php if($saldoKas >= 0): ?>

                <p class="text-xs text-blue-600 mt-2">
                    Kondisi keuangan masih surplus.
                </p>

            <?php else: ?>

                <p class="text-xs text-red-600 mt-2">
                    Pengeluaran lebih besar daripada pemasukan.
                </p>

            <?php endif; ?>

        </div>

    </div>


    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">

        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">

            <div>
                <label class="block text-sm text-gray-600 mb-1">
                    Dari Tanggal
                </label>

                <input
                    type="date"
                    name="dari"
                    value="<?php echo e(request('dari')); ?>"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2">
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">
                    Sampai Tanggal
                </label>

                <input
                    type="date"
                    name="sampai"
                    value="<?php echo e(request('sampai')); ?>"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2">
            </div>

            <div>

                <label class="block text-sm text-gray-600 mb-1">
                    Jenis Transaksi
                </label>

                <select
                    name="filter_jenis"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2">

                    <option value="">
                        Semua Transaksi
                    </option>

                    <option value="masuk"
                        <?php echo e(request('filter_jenis') == 'masuk' ? 'selected' : ''); ?>>
                        Kas Masuk
                    </option>

                    <option value="keluar"
                        <?php echo e(request('filter_jenis') == 'keluar' ? 'selected' : ''); ?>>
                        Kas Keluar
                    </option>

                </select>

            </div>

            <div>

                <button
                    type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white rounded-xl py-2.5 font-semibold">

                    Filter

                </button>

            </div>

            <div>

                <a href="<?php echo e(route('admin.kas.index','masuk')); ?>"
                    class="block text-center bg-gray-200 hover:bg-gray-300 rounded-xl py-2.5">

                    Reset

                </a>

            </div>

        </form>

    </div>


    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="px-6 py-5 border-b">

            <h3 class="text-lg font-bold text-gray-800">
                Riwayat Transaksi
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Seluruh transaksi kas masuk dan kas keluar.
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-5 py-4 text-left">Tanggal</th>
                        <th class="px-5 py-4 text-left">Jenis</th>
                        <th class="px-5 py-4 text-left">Keterangan</th>
                        <th class="px-5 py-4 text-right">
    Nominal
</th>

<th class="px-5 py-4 text-center">
    Dicatat Oleh
</th>

<th class="px-5 py-4 text-center">
    Aksi
</th>

</tr>

</thead>

<tbody class="divide-y divide-gray-100">

<?php $__empty_1 = true; $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

<tr class="hover:bg-gray-50">

    <td class="px-5 py-4">
        <?php echo e($t->tanggal->format('d M Y')); ?>

    </td>

    <td class="px-5 py-4">

        <?php if($t->jenis == 'masuk'): ?>

            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                Kas Masuk
            </span>

        <?php else: ?>

            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                Kas Keluar
            </span>

        <?php endif; ?>

    </td>

    <td class="px-5 py-4">
        <?php echo e($t->keterangan); ?>

    </td>

    <td class="px-5 py-4 text-right font-semibold">

        <span class="<?php echo e($t->jenis == 'masuk' ? 'text-green-600' : 'text-red-600'); ?>">

            <?php echo e($t->jenis == 'masuk' ? '+' : '-'); ?>

            Rp <?php echo e(number_format($t->nominal,0,',','.')); ?>


        </span>

    </td>

    <td class="px-5 py-4 text-center">
        <?php echo e($t->user->name ?? '-'); ?>

    </td>

    <td class="px-5 py-4 text-center">

        <form
            action="<?php echo e(route('admin.kas.destroy',$t->id)); ?>"
            method="POST"
            onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">

            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>

            <button
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs">

                Hapus

            </button>

        </form>

    </td>

</tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<tr>

    <td colspan="6" class="px-6 py-8 text-center text-gray-500">

        Belum ada transaksi.

    </td>

</tr>


                    <?php endif; ?>

                </tbody>

            </table>

        </div>

        
        <div class="px-6 py-4 border-t border-gray-100">

            <?php echo e($transaksi->links()); ?>


        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/admin/kas/index.blade.php ENDPATH**/ ?>