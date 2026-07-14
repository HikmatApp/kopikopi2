<?php
$isAdmin = auth()->user()->isAdmin();
?>

<?php $__env->startSection('page-title', $isAdmin ? 'Data Pemesanan Mitra' : 'Pesanan Saya'); ?>
<?php $__env->startSection('page-subtitle', $isAdmin ? 'Kelola seluruh pemesanan dari mitra' : 'Riwayat pemesanan barang'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
<div class="mb-5 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<?php if(session('error')): ?>
<div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3">
    <?php echo e(session('error')); ?>

</div>
<?php endif; ?>

<?php if (! ($isAdmin)): ?>

<div class="flex justify-end mb-5">

    <a href="<?php echo e(route('mitra.stok')); ?>"
        class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-xl shadow font-semibold">

        + Pesan Barang

    </a>

</div>

<?php endif; ?>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    <table class="w-full text-sm">

        <thead class="bg-gray-100 text-gray-700">

            <tr>

                <th class="px-4 py-3">
                    No
                </th>

                <?php if($isAdmin): ?>

                <th class="px-4 py-3">
                    Mitra
                </th>

                <?php endif; ?>

                <th class="px-4 py-3">
                    Barang
                </th>

                <th class="px-4 py-3">
                    Qty
                </th>

                <th class="px-4 py-3">
                    Harga
                </th>

                <th class="px-4 py-3">
                    Total
                </th>

                <th class="px-4 py-3">
                    Status
                </th>

                <th class="px-4 py-3">
                    Tanggal
                </th>

                <th class="px-4 py-3 text-center">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody class="divide-y">

            <?php $__empty_1 = true; $__currentLoopData = $pemesanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <tr class="hover:bg-gray-50">

                <td class="px-4 py-3">

                    <?php echo e($loop->iteration + (($pemesanan->currentPage()-1) * $pemesanan->perPage())); ?>


                </td>

                <?php if($isAdmin): ?>

                <td class="px-4 py-3 font-medium">

                    <?php echo e($p->mitra->name); ?>


                </td>

                <?php endif; ?>

                <td class="px-4 py-3">

                    <?php echo e($p->barang->nama_barang); ?>


                </td>

                <td class="px-4 py-3">

                    <?php echo e($p->jumlah); ?>


                </td>

                <td class="px-4 py-3">

                    <?php echo e($p->harga_satuan_format); ?>


                </td>

                <td class="px-4 py-3 font-semibold text-green-600">

                    <?php echo e($p->total_harga_format); ?>


                </td>

                <td class="px-4 py-3">
                    <?php if($isAdmin): ?>

                    <form action="<?php echo e(route('admin.pemesanan.status', $p->id)); ?>"
                        method="POST">

                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>

                        <select
                            name="status"
                            onchange="this.form.submit()"
                            class="border rounded-lg px-2 py-1 text-xs">

                            <option value="pending"
                                <?php echo e($p->status == 'pending' ? 'selected' : ''); ?>>
                                Pending
                            </option>

                            <option value="diproses"
                                <?php echo e($p->status == 'diproses' ? 'selected' : ''); ?>>
                                Diproses
                            </option>

                            <option value="selesai"
                                <?php echo e($p->status == 'selesai' ? 'selected' : ''); ?>>
                                Selesai
                            </option>

                            <option value="ditolak"
                                <?php echo e($p->status == 'ditolak' ? 'selected' : ''); ?>>
                                Ditolak
                            </option>

                        </select>

                    </form>

                    <?php else: ?>

                    <span
                        class="px-2 py-1 rounded-full text-xs font-medium <?php echo e($p->status_badge); ?>">

                        <?php echo e(ucfirst($p->status)); ?>


                    </span>

                    <?php endif; ?>

                </td>

                <td class="px-4 py-3 text-gray-500">

                    <?php echo e($p->created_at->format('d M Y H:i')); ?>


                </td>

                <td class="px-4 py-3">

                    <div class="flex items-center gap-2">

                        <a href="<?php echo e(route('pemesanan.show', $p->id)); ?>"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-xs">

                            Detail

                        </a>

                        <?php if(!$isAdmin && $p->status == 'pending'): ?>

                        <form
                            action="<?php echo e(route('pemesanan.destroy', $p->id)); ?>"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs">

                                Hapus

                            </button>

                        </form>

                        <?php endif; ?>

                    </div>

                </td>

            </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <tr>

                <td colspan="<?php echo e($isAdmin ? 9 : 8); ?>"
                    class="text-center py-10 text-gray-400">

                    Belum ada data pemesanan.

                </td>

            </tr>
            <?php endif; ?>

        </tbody>

    </table>


    <div class="p-4">

        <?php echo e($pemesanan->links()); ?>


    </div>


</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/pemesanan/index.blade.php ENDPATH**/ ?>