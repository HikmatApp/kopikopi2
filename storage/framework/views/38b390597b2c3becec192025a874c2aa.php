<?php $__env->startSection('page-title', 'Kelola User'); ?>
<?php $__env->startSection('page-subtitle', 'Kelola seluruh akun admin dan mitra dalam sistem'); ?>

<?php $__env->startSection('content'); ?>

<!-- FILTER -->
<div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-4 mb-5">
    <form method="GET" class="flex flex-col sm:flex-row gap-3">
        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama/email..."
            class="border border-gray-200 rounded-xl px-4 py-2.5 w-full focus:ring-2 focus:ring-orange-400 outline-none text-sm">

        <select name="role" class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm">
            <option value="">Semua Role</option>
            <option value="admin" <?php echo e(request('role') == 'admin' ? 'selected' : ''); ?>>Admin</option>
            <option value="mitra" <?php echo e(request('role') == 'mitra' ? 'selected' : ''); ?>>Mitra</option>
        </select>

        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition">Cari</button>
        <a href="<?php echo e(route('admin.user.index')); ?>" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-5 py-2.5 rounded-xl text-sm font-medium text-center transition">Reset</a>
    </form>
</div>

<div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">
    <table class="w-full text-left text-sm">
        <thead class="bg-gray-900 text-white">
            <tr>
                <th class="p-4 font-semibold">Nama</th>
                <th class="p-4 font-semibold">Email</th>
                <th class="p-4 font-semibold">Role</th>
                <th class="p-4 font-semibold">Status</th>
                <th class="p-4 font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
                <td class="p-4 font-medium text-gray-800">
                    <?php echo e($u->name); ?>

                    <?php if($u->id === auth()->id()): ?><span class="text-xs text-gray-400">(Anda)</span><?php endif; ?>
                </td>
                <td class="p-4 text-gray-600"><?php echo e($u->email); ?></td>
                <td class="p-4">
                    <form action="<?php echo e(route('admin.user.role', $u->id)); ?>" method="POST" class="flex items-center gap-2">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <select name="role" onchange="this.form.submit()" <?php echo e($u->id === auth()->id() ? 'disabled' : ''); ?>

                            class="border border-gray-200 rounded-lg px-2 py-1 text-xs <?php echo e($u->role == 'admin' ? 'bg-gray-900 text-white' : 'bg-orange-50 text-orange-700'); ?>">
                            <option value="admin" <?php echo e($u->role == 'admin' ? 'selected' : ''); ?>>Admin</option>
                            <option value="mitra" <?php echo e($u->role == 'mitra' ? 'selected' : ''); ?>>Mitra</option>
                        </select>
                    </form>
                </td>
                <td class="p-4">
                    <?php if($u->is_active): ?>
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                    <?php else: ?>
                        <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">Non Aktif</span>
                    <?php endif; ?>
                </td>
                <td class="p-4">
                    <div class="flex gap-2">
                        <form action="<?php echo e(route('admin.user.toggle', $u->id)); ?>" method="POST" onsubmit="return confirm('Ubah status aktif user ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button <?php echo e($u->id === auth()->id() ? 'disabled' : ''); ?>

                                class="bg-blue-50 text-blue-600 hover:bg-blue-100 disabled:opacity-40 px-3 py-1.5 rounded-lg text-xs font-medium transition">
                                <?php echo e($u->is_active ? 'Nonaktifkan' : 'Aktifkan'); ?>

                            </button>
                        </form>
                        <form action="<?php echo e(route('admin.user.destroy', $u->id)); ?>" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button <?php echo e($u->id === auth()->id() ? 'disabled' : ''); ?>

                                class="bg-red-50 text-red-600 hover:bg-red-100 disabled:opacity-40 px-3 py-1.5 rounded-lg text-xs font-medium transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5" class="p-8 text-center text-gray-400">Tidak ada pengguna</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="p-4"><?php echo e($users->links()); ?></div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/admin/user/index.blade.php ENDPATH**/ ?>