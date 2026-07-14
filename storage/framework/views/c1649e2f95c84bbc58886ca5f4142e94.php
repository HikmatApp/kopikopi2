<?php $__env->startSection('page-title', 'Profile Saya'); ?>
<?php $__env->startSection('page-subtitle', 'Informasi akun ' . (auth()->user()->isAdmin() ? 'administrator' : 'mitra') . ' KopiKopi'); ?>

<?php $__env->startSection('content'); ?>

<!-- PROFIL CARD -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
        <div class="w-24 h-24 rounded-full bg-orange-100 flex items-center justify-center mx-auto mb-4 text-3xl font-bold text-orange-600">
            <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

        </div>
        <h2 class="text-lg font-bold text-gray-800"><?php echo e(auth()->user()->name); ?></h2>
        <p class="text-gray-400 text-sm"><?php echo e(auth()->user()->email); ?></p>
        <span class="inline-block mt-3 text-xs font-semibold px-3 py-1 rounded-full <?php echo e(auth()->user()->isAdmin() ? 'bg-gray-900 text-white' : 'bg-orange-100 text-orange-700'); ?>">
            <?php echo e(strtoupper(auth()->user()->role)); ?>

        </span>
    </div>

    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-gray-800">📋 Informasi Akun</h3>
        </div>
        <div class="grid grid-cols-2 gap-y-4 text-sm">
            <div>
                <p class="text-gray-400">Nama</p>
                <p class="font-semibold text-gray-800"><?php echo e(auth()->user()->name); ?></p>
            </div>
            <div>
                <p class="text-gray-400">Email</p>
                <p class="font-semibold text-gray-800"><?php echo e(auth()->user()->email); ?></p>
            </div>
            <div>
                <p class="text-gray-400">Role</p>
                <p class="font-semibold text-gray-800"><?php echo e(ucfirst(auth()->user()->role)); ?></p>
            </div>
            <div>
                <p class="text-gray-400">Status Akun</p>
                <p class="font-semibold text-green-600">● Aktif</p>
            </div>
            <div>
                <p class="text-gray-400">Bergabung Sejak</p>
                <p class="font-semibold text-gray-800"><?php echo e(auth()->user()->created_at->format('d F Y')); ?></p>
            </div>
        </div>
    </div>
</div>

<!-- EDIT PROFIL FORM -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-gray-100"><h3 class="font-bold text-gray-800">✏️ Edit Profile</h3></div>
    <form action="<?php echo e(route('pengaturan.profil')); ?>" method="POST" class="p-6 space-y-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama</label>
                <input type="text" name="name" value="<?php echo e(old('name', auth()->user()->name)); ?>" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-400 outline-none">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email" value="<?php echo e(old('email', auth()->user()->email)); ?>" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-400 outline-none">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-orange-500 hover:bg-orange-600 text-white font-semibold transition">Simpan Profil</button>
        </div>
    </form>
</div>

<!-- KEAMANAN AKUN -->
<div class="bg-orange-500 rounded-2xl p-6 text-white mb-6">
    <h3 class="text-xl font-bold">🔒 Keamanan Akun</h3>
    <p class="text-orange-100 text-sm mt-1">Pastikan akun KopiKopi kamu tetap aman.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-800 mb-4">🛡️ Status Akun</h3>
        <dl class="space-y-3 text-sm">
            <div><dt class="text-gray-400">Nama Pengguna</dt><dd class="font-semibold text-gray-800"><?php echo e(auth()->user()->name); ?></dd></div>
            <div><dt class="text-gray-400">Email</dt><dd class="font-semibold text-gray-800"><?php echo e(auth()->user()->email); ?></dd></div>
            <div class="flex justify-between items-center"><dt class="text-gray-400">Status Akun</dt><dd><span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Aktif</span></dd></div>
        </dl>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-800 mb-1">🔑 Ubah Password</h3>
        <p class="text-gray-400 text-sm mb-4">Gunakan password yang kuat untuk menjaga keamanan akun.</p>
        <form action="<?php echo e(route('pengaturan.password')); ?>" method="POST" class="space-y-4">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Lama</label>
                <input type="password" name="current_password" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-400 outline-none">
                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-400 outline-none">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-400 outline-none">
            </div>
            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2.5 rounded-xl transition">💾 Simpan Password</button>
        </form>
    </div>
</div>

<!-- PENGATURAN APLIKASI (ADMIN ONLY) -->
<?php if(auth()->user()->isAdmin() && $pengaturan): ?>
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100"><h3 class="font-bold text-gray-800">🏪 Pengaturan Aplikasi</h3></div>
    <form action="<?php echo e(route('admin.pengaturan.aplikasi')); ?>" method="POST" class="p-6 space-y-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Usaha</label>
            <input type="text" name="nama_usaha" value="<?php echo e(old('nama_usaha', $pengaturan->nama_usaha)); ?>" required
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-400 outline-none">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat</label>
                <input type="text" name="alamat" value="<?php echo e(old('alamat', $pengaturan->alamat)); ?>"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-400 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Kontak</label>
                <input type="text" name="kontak" value="<?php echo e(old('kontak', $pengaturan->kontak)); ?>"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-400 outline-none">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Ambang Batas Stok Minimum Default</label>
            <input type="number" name="stok_minimum_default" min="0" value="<?php echo e(old('stok_minimum_default', $pengaturan->stok_minimum_default)); ?>" required
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-orange-400 outline-none">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-orange-500 hover:bg-orange-600 text-white font-semibold transition">Simpan Pengaturan</button>
        </div>
    </form>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/pengaturan/edit.blade.php ENDPATH**/ ?>