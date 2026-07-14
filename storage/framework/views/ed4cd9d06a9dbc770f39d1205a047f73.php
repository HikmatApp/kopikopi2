<?php $__env->startSection('page-title', 'Katalog Stok Barang'); ?>
<?php $__env->startSection('page-subtitle', 'Pilih barang yang ingin dipesan'); ?>

<?php $__env->startSection('content'); ?>

<div class="bg-white rounded-2xl shadow border border-gray-100 p-5 mb-6">

    <form method="GET">

        <div class="flex gap-3">

            <input
                type="text"
                name="search"
                value="<?php echo e(request('search')); ?>"
                placeholder="Cari barang..."
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-400 outline-none">

            <button
                class="bg-orange-500 hover:bg-orange-600 text-white px-6 rounded-xl">

                Cari

            </button>

        </div>

    </form>

</div>

<div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="px-5 py-4 text-left">
                    Nama Barang
                </th>

                <th class="px-5 py-4 text-left">
                    Kategori
                </th>

                <th class="px-5 py-4 text-left">
                    Harga
                </th>

                <th class="px-5 py-4 text-center">
                    Stok
                </th>

                <th class="px-5 py-4 text-center">
                    Satuan
                </th>

                <th class="px-5 py-4 text-center">
                    Status
                </th>

                <th class="px-5 py-4 text-center">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <tr class="border-t hover:bg-orange-50">

                <td class="px-5 py-4 font-semibold">

                    <?php echo e($b->nama_barang); ?>


                </td>

                <td class="px-5 py-4">

                    <?php echo e($b->kategori); ?>


                </td>

                <td class="px-5 py-4 text-green-600 font-bold">

                    Rp <?php echo e(number_format($b->harga_beli * 1.2,0,',','.')); ?>


                </td>

                <td class="px-5 py-4 text-center">

                    <?php echo e($b->stok); ?>


                </td>

                <td class="px-5 py-4 text-center">

                    <?php echo e($b->satuan); ?>


                </td>

                <td class="px-5 py-4 text-center">

                    <span class="px-3 py-1 rounded-full text-xs <?php echo e($b->status_badge); ?>">

                        <?php echo e($b->status); ?>


                    </span>

                </td>

                <td class="px-5 py-4 text-center">

                    <?php if($b->stok > 0): ?>

                    <a
                        href="<?php echo e(route('pemesanan.create',['barang'=>$b->id])); ?>"
                        class="inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg">

                        Pesan

                    </a>

                    <?php else: ?>

                    <button
                        disabled
                        class="px-4 py-2 bg-gray-300 rounded-lg text-white cursor-not-allowed">

                        Habis

                    </button>

                    <?php endif; ?>

                </td>

            </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <tr>

                <td colspan="7" class="text-center py-10 text-gray-400">

                    Belum ada stok barang.

                </td>

            </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/mitra/stok.blade.php ENDPATH**/ ?>