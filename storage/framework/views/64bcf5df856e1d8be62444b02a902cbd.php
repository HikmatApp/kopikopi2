<?php $__env->startSection('page-title', 'Edit Barang'); ?>
<?php $__env->startSection('page-subtitle', $barang->nama_barang); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-xl bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-indigo-600 to-indigo-500 px-6 py-6 text-white">
        <h1 class="text-xl font-bold">Edit Barang</h1>
        <p class="text-sm text-indigo-100 mt-1">Perbarui data stok barang</p>
    </div>

    <form action="<?php echo e(route('admin.stok.update', $barang->id)); ?>" method="POST" class="p-6 space-y-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Barang</label>
            <input type="text" name="nama_barang" value="<?php echo e(old('nama_barang', $barang->nama_barang)); ?>" required
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori</label>
                <input type="text" name="kategori" value="<?php echo e(old('kategori', $barang->kategori)); ?>" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Satuan</label>
                <input type="text" name="satuan" value="<?php echo e(old('satuan', $barang->satuan)); ?>" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Stok</label>
                <input type="number" name="stok" min="0" value="<?php echo e(old('stok', $barang->stok)); ?>" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 outline-none">
                <p class="text-xs text-gray-400 mt-1">Perubahan otomatis tercatat di riwayat pergerakan stok.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Stok Minimum</label>
                <input type="number" name="stok_minimum" min="0" value="<?php echo e(old('stok_minimum', $barang->stok_minimum)); ?>" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="<?php echo e(route('admin.stok.index')); ?>" class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 transition">Batal</a>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition">Update</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/admin/stok/edit.blade.php ENDPATH**/ ?>