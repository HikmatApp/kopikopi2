<?php $isMasuk = $jenis === 'masuk'; ?>

<?php $__env->startSection('page-title', 'Tambah Transaksi'); ?>
<?php $__env->startSection('page-subtitle', 'Catat transaksi ' . ($isMasuk ? 'kas masuk' : 'kas keluar')); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-xl bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <h1 class="text-xl font-bold text-gray-800">Tambah Transaksi</h1>
    </div>

    <form action="<?php echo e(route('admin.kas.store', $jenis)); ?>" method="POST" class="p-6 space-y-4">
        <?php echo csrf_field(); ?>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Jenis Transaksi</label>
            <select disabled class="w-full border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50 text-gray-500">
                <option><?php echo e($isMasuk ? 'Kas Masuk' : 'Kas Keluar'); ?></option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal</label>
            <input type="date" name="tanggal" value="<?php echo e(old('tanggal', now()->format('Y-m-d'))); ?>" required
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
            <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Keterangan</label>
            <input type="text" name="keterangan" value="<?php echo e(old('keterangan')); ?>" required
                placeholder="<?php echo e($isMasuk ? 'Contoh: Penjualan harian' : 'Contoh: Beli bahan baku'); ?>"
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
            <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nominal (Rp)</label>
            <input type="number" name="nominal" min="1" value="<?php echo e(old('nominal')); ?>" required
                placeholder="Contoh: 100000"
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
            <?php $__errorArgs = ['nominal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="<?php echo e(route('admin.kas.index', $jenis)); ?>" class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 transition">Batal</a>
            <button type="submit" class="px-5 py-2.5 rounded-xl <?php echo e($isMasuk ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600'); ?> text-white font-semibold transition">Simpan</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/admin/kas/create.blade.php ENDPATH**/ ?>