<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KopiKopi</title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css']); ?>
</head>

<body class="min-h-screen bg-black">

    <!-- Background -->
    <div class="fixed inset-0">
        <img
            src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1920"
            class="w-full h-full object-cover"
            alt="Coffee">

        <div class="absolute inset-0 bg-black/70"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl">

            <!-- Logo -->
            <div class="text-center">

                <div class="text-6xl mb-3">☕</div>

                <h1 class="text-5xl font-bold text-white">KopiKopi</h1>

                <p class="text-gray-300 mt-2">Masuk ke sistem</p>

            </div>

            <!-- ERROR -->
            <?php if($errors->any()): ?>
                <div class="bg-red-500/20 text-red-300 p-3 rounded-xl mt-6">
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <!-- FORM -->
            <form method="POST" action="<?php echo e(route('login')); ?>" class="mt-8">
                <?php echo csrf_field(); ?>

                <!-- EMAIL -->
                <div class="mb-4">
                    <label class="text-white block mb-2">Email</label>
                    <input type="email" name="email" required
                        class="w-full p-4 rounded-xl bg-white/10 border border-white/20 text-white focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <!-- PASSWORD -->
                <div class="mb-6">
                    <label class="text-white block mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full p-4 rounded-xl bg-white/10 border border-white/20 text-white focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-amber-600 hover:bg-amber-700 text-white py-4 rounded-xl font-semibold transition">
                    Login
                </button>

            </form>

            <!-- REGISTER -->
            <div class="text-center mt-6">
                <a href="<?php echo e(route('register')); ?>" class="text-gray-300 hover:text-white">
                    Belum punya akun?
                    <span class="text-amber-400">Register sekarang</span>
                </a>
            </div>

    </div>

</body>

</html><?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/auth/login.blade.php ENDPATH**/ ?>