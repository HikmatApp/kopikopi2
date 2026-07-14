<?php $__env->startSection('page-title', 'Stok Barang'); ?>
<?php $__env->startSection('page-subtitle', 'Kelola seluruh data persediaan barang'); ?>

<?php $__env->startSection('content'); ?>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-5 flex justify-between items-center">

    <div>
        <h2 class="font-bold text-gray-800 text-lg">
            📦 Stok Barang (Admin)
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Kelola seluruh data persediaan barang.
        </p>
    </div>

    <div class="flex gap-3">

        <a href="<?php echo e(route('admin.dashboard')); ?>"
            class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-4 py-2.5 rounded-xl transition">

            ← Kembali

        </a>

        <button
            type="button"
            onclick="openModal()"
            class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">

            + Tambah Barang

        </button>

    </div>

</div>

<?php if($barangMenipis > 0): ?>

<div
    class="mb-5 bg-yellow-50 border border-yellow-200 rounded-xl px-5 py-4">

    <div class="flex items-center">

        <div class="text-yellow-600 text-xl mr-3">
            ⚠️
        </div>

        <div>

            <div class="font-semibold text-yellow-700">

                Ada <?php echo e($barangMenipis); ?> barang dengan stok menipis / habis

            </div>

            <div class="text-sm text-yellow-600">

                Segera lakukan penambahan stok.

            </div>

        </div>

    </div>

</div>

<?php endif; ?>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-5">

    <form
        action="<?php echo e(route('admin.stok.index')); ?>"
        method="GET"
        class="grid md:grid-cols-4 gap-4">

        <input
            type="text"
            name="search"
            value="<?php echo e(request('search')); ?>"
            placeholder="Cari nama barang..."
            class="border rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-400 outline-none">

        <select
            name="kategori"
            class="border rounded-xl px-4 py-2.5">

            <option value="">

                Semua Kategori

            </option>

            <?php $__currentLoopData = $kategoriList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <option
                value="<?php echo e($kategori); ?>"
                <?php echo e(request('kategori')==$kategori ? 'selected':''); ?>>

                <?php echo e($kategori); ?>


            </option>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>

        <button
            class="bg-orange-500 hover:bg-orange-600 text-white rounded-xl">

            Cari

        </button>

        <a
            href="<?php echo e(route('admin.stok.index')); ?>"
            class="bg-gray-100 hover:bg-gray-200 rounded-xl flex items-center justify-center">

            Reset

        </a>

    </form>

</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-4">No</th>

                <th class="p-4">Nama Barang</th>

                <th class="p-4">Kategori</th>

                <th class="p-4">Satuan</th>

                <th class="p-4">Harga Beli</th>

                <th class="p-4">Stok</th>

                <th class="p-4">Minimum</th>

                <th class="p-4">Status</th>

                <th class="p-4 text-center">Aksi</th>

            </tr>

        </thead>

        <tbody class="divide-y">

            <?php $__empty_1 = true; $__currentLoopData = $barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <tr class="hover:bg-gray-50">

                <td class="p-4">

                    <?php echo e($loop->iteration); ?>


                </td>

                <td class="p-4 font-semibold">

                    <a
                        href="<?php echo e(route('admin.stok.show',$item->id)); ?>"
                        class="hover:text-orange-600">

                        <?php echo e($item->nama_barang); ?>


                    </a>

                </td>

                <td class="p-4">

                    <?php echo e($item->kategori); ?>


                </td>

                <td class="p-4">

                    <?php echo e($item->satuan); ?>


                </td>

                <td class="p-4 font-semibold text-green-700">

                    <?php echo e($item->harga_beli_format); ?>


                </td>

                <td class="p-4">

                    <?php echo e($item->stok); ?>


                </td>

                <td class="p-4">

                    <?php echo e($item->stok_minimum); ?>


                </td>

                <td class="p-4">

                    <span
                        class="px-3 py-1 rounded-full text-xs <?php echo e($item->status_badge); ?>">

                        <?php echo e($item->status); ?>


                    </span>

                </td>

                <td class="p-4">

                    <div class="flex gap-2 justify-center">

                        <a
                            href="<?php echo e(route('admin.stok.edit',$item->id)); ?>"
                            class="bg-blue-100 text-blue-600 px-3 py-1 rounded-lg">

                            Edit

                        </a>

                        <form
                            action="<?php echo e(route('admin.stok.destroy',$item->id)); ?>"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus barang ini?')">

                            <?php echo csrf_field(); ?>

                            <?php echo method_field('DELETE'); ?>

                            <button
                                class="bg-red-100 text-red-600 px-3 py-1 rounded-lg">

                                Hapus

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <tr>

                <td colspan="9"
                    class="text-center p-10 text-gray-400">

                    Belum ada data barang.

                </td>

            </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>

<!-- MODAL TAMBAH BARANG -->

<div
    id="modal"
    class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex justify-center items-center p-5 z-50">

    <div
        class="bg-white w-full max-w-2xl rounded-2xl overflow-hidden shadow-2xl">

        <div
            class="bg-gradient-to-r from-orange-500 to-orange-600 text-white p-6">

            <h2 class="font-bold text-xl">

                Tambah Barang

            </h2>

            <p class="text-sm opacity-90">

                Lengkapi informasi barang berikut.

            </p>

        </div>

        <form
            action="<?php echo e(route('admin.stok.store')); ?>"
            method="POST"
            class="p-6 space-y-5">

            <?php echo csrf_field(); ?>
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Nama Barang

                </label>

                <input
                    type="text"
                    name="nama_barang"
                    value="<?php echo e(old('nama_barang')); ?>"
                    required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-500 outline-none"
                    placeholder="Contoh : Kopi Arabica">

            </div>

            <div class="grid md:grid-cols-2 gap-5">

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Kategori

                    </label>

                    <select
                        name="kategori"
                        required
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-500 outline-none">

                        <option value="">-- Pilih Kategori --</option>

                        <?php $__currentLoopData = $kategoriList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option
                            value="<?php echo e($kategori); ?>"
                            <?php echo e(old('kategori') == $kategori ? 'selected' : ''); ?>>

                            <?php echo e($kategori); ?>


                        </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Satuan

                    </label>

                    <select
                        name="satuan"
                        required
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-500 outline-none">

                        <option value="">-- Pilih Satuan --</option>

                        <?php $__currentLoopData = $satuanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $satuan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option
                            value="<?php echo e($satuan); ?>"
                            <?php echo e(old('satuan') == $satuan ? 'selected' : ''); ?>>

                            <?php echo e($satuan); ?>


                        </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>

                </div>

            </div>

            <div class="grid md:grid-cols-2 gap-5">

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Harga Beli

                    </label>

                    <input
                        type="number"
                        name="harga_beli"
                        value="<?php echo e(old('harga_beli')); ?>"
                        min="0"
                        step="0.01"
                        required
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-500 outline-none"
                        placeholder="95000">

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Jumlah Stok

                    </label>

                    <input
                        type="number"
                        name="stok"
                        value="<?php echo e(old('stok')); ?>"
                        min="0"
                        required
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-500 outline-none"
                        placeholder="100">

                </div>

            </div>

            <div class="grid md:grid-cols-2 gap-5">

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Stok Minimum

                    </label>

                    <input
                        type="number"
                        name="stok_minimum"
                        value="<?php echo e(old('stok_minimum',10)); ?>"
                        min="0"
                        required
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-500 outline-none">

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Deskripsi Barang

                    </label>

                    <textarea
                        name="deskripsi"
                        rows="3"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-500 outline-none"
                        placeholder="Opsional"><?php echo e(old('deskripsi')); ?></textarea>

                </div>

            </div>

            <?php if($errors->any()): ?>

            <div class="bg-red-50 border border-red-200 rounded-xl p-4">

                <ul class="text-sm text-red-600 space-y-1">

                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <li>

                        • <?php echo e($error); ?>


                    </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>

            </div>

            <?php endif; ?>

            <div class="flex justify-end gap-3 pt-5">

                <button
                    type="button"
                    onclick="closeModal()"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-xl">

                    Batal

                </button>

                <button
                    type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2.5 rounded-xl">

                    Simpan Barang

                </button>

            </div>

        </form>

    </div>

</div>
<script>
    function openModal() {

        document
            .getElementById('modal')
            .classList
            .remove('hidden');

    }

    function closeModal() {

        document
            .getElementById('modal')
            .classList
            .add('hidden');

    }

    // Tutup modal ketika klik area luar
    document.addEventListener('click', function(e) {

        const modal = document.getElementById('modal');

        if (e.target === modal) {

            closeModal();

        }

    });

    // Tutup modal dengan tombol ESC
    document.addEventListener('keydown', function(e) {

        if (e.key === 'Escape') {

            closeModal();

        }

    });

    // Jika validasi gagal, modal otomatis terbuka lagi
    <?php if($errors->any()): ?>

    document.addEventListener('DOMContentLoaded', function() {

        openModal();

    });

    <?php endif; ?>
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/admin/stok/index.blade.php ENDPATH**/ ?>