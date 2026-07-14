@php
    $isAdmin = auth()->user()->isAdmin();
    $barangMenipis = $isAdmin ? \App\Models\StokBarang::get()->filter(fn($b) => $b->status !== 'Aman')->count() : 0;

    // Palet: admin pakai sidebar terang + aksen oranye, mitra pakai sidebar gelap slate.
    $sidebarBg   = $isAdmin ? 'bg-white border-r border-gray-100' : 'bg-slate-800';
    $textNormal  = $isAdmin ? 'text-gray-600' : 'text-slate-300';
    $textMuted   = $isAdmin ? 'text-gray-400' : 'text-slate-400';
    $hoverBg     = $isAdmin ? 'hover:bg-gray-50' : 'hover:bg-slate-700/60';
    $activeBg    = $isAdmin ? 'bg-orange-500 text-white shadow-sm' : 'bg-orange-500 text-white shadow-sm';
@endphp
<aside class="w-64 shrink-0 {{ $sidebarBg }} flex flex-col h-screen sticky top-0 overflow-y-auto">

    <!-- LOGO -->
    <div class="px-6 py-6">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <span class="text-2xl">☕</span>
            <span class="text-xl font-extrabold {{ $isAdmin ? 'text-orange-600' : 'text-white' }}">KopiKopi</span>
        </a>
        <p class="text-xs {{ $textMuted }} mt-1 ml-9">Coffee Management System</p>

        @if ($isAdmin)
            <span class="inline-block mt-3 text-[11px] font-semibold tracking-wide text-orange-600 bg-orange-100 px-3 py-1 rounded-full">
                ADMIN PANEL
            </span>
        @else
            <span class="inline-block mt-3 text-[11px] font-semibold tracking-wide text-orange-300 bg-slate-700 px-3 py-1 rounded-full">
                MITRA PANEL
            </span>
        @endif
    </div>

    <div class="border-t {{ $isAdmin ? 'border-gray-100' : 'border-slate-700' }}"></div>

    <!-- MENU -->
    <nav class="flex-1 px-4 py-4 space-y-1">
        @if ($isAdmin)
            @php
                $menu = [
                    ['route' => 'admin.dashboard', 'is' => 'admin.dashboard', 'icon' => '📊', 'label' => 'Dashboard'],
                    ['route' => 'admin.mitra.index', 'is' => 'admin.mitra.*', 'icon' => '👥', 'label' => 'Data Mitra'],
                    ['route' => 'admin.stok.index', 'is' => 'admin.stok.*', 'icon' => '📦', 'label' => 'Stok Barang'],
                    ['route' => 'pemesanan.index', 'is' => 'pemesanan.*', 'icon' => '🧾', 'label' => 'Pemesanan'],
                    ['route' => 'admin.kas.index', 'params' => 'masuk', 'is' => 'admin.kas.*', 'icon' => '💳', 'label' => 'Kas / Transaksi'],
                    ['route' => 'laporan.index', 'is' => 'laporan.*', 'icon' => '📈', 'label' => 'Laporan'],
                    ['route' => 'admin.user.index', 'is' => 'admin.user.*', 'icon' => '🛡️', 'label' => 'Kelola User'],
                ];
            @endphp
            @foreach ($menu as $m)
                @php $active = request()->routeIs($m['is']); @endphp
                <a href="{{ isset($m['params']) ? route($m['route'], $m['params']) : route($m['route']) }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                        {{ $active ? $activeBg : $textNormal . ' ' . $hoverBg }}">
                    <span class="text-lg">{{ $m['icon'] }}</span>
                    {{ $m['label'] }}
                </a>
            @endforeach

            <div class="pt-3 mt-3 border-t {{ $isAdmin ? 'border-gray-100' : 'border-slate-700' }}">
                <p class="px-4 text-[11px] uppercase tracking-wide {{ $textMuted }} mb-1">Pengaturan</p>
                @php $active = request()->routeIs('pengaturan.*'); @endphp
                <a href="{{ route('pengaturan.edit') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                        {{ $active ? $activeBg : $textNormal . ' ' . $hoverBg }}">
                    <span class="text-lg">⚙️</span> Profile &amp; Keamanan
                </a>
            </div>
        @else
            @php
                $menu = [
                    ['route' => 'mitra.dashboard', 'is' => 'mitra.dashboard', 'icon' => '📊', 'label' => 'Dashboard'],
                    ['route' => 'mitra.stok', 'is' => 'mitra.stok', 'icon' => '📦', 'label' => 'Katalog Stok'],
                    ['route' => 'pemesanan.index', 'is' => 'pemesanan.*', 'icon' => '🛒', 'label' => 'Pesanan Saya'],
                    ['route' => 'laporan.index', 'is' => 'laporan.*', 'icon' => '📈', 'label' => 'Laporan Saya'],
                    ['route' => 'pengaturan.edit', 'is' => 'pengaturan.*', 'icon' => '⚙️', 'label' => 'Pengaturan'],
                ];
            @endphp
            @foreach ($menu as $m)
                @php $active = request()->routeIs($m['is']); @endphp
                <a href="{{ route($m['route']) }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                        {{ $active ? $activeBg : $textNormal . ' ' . $hoverBg }}">
                    <span class="text-lg">{{ $m['icon'] }}</span>
                    {{ $m['label'] }}
                </a>
            @endforeach
        @endif
    </nav>

    <!-- USER FOOTER -->
    <div class="px-4 py-4 border-t {{ $isAdmin ? 'border-gray-100' : 'border-slate-700' }}">
        <div class="flex items-center gap-3 px-2 mb-3">
            <div class="w-9 h-9 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="text-sm font-semibold truncate {{ $isAdmin ? 'text-gray-800' : 'text-white' }}">{{ auth()->user()->name }}</p>
                <p class="text-xs {{ $textMuted }}">{{ $isAdmin ? 'Administrator' : 'Mitra KopiKopi' }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold py-2.5 rounded-xl transition">
                🚪 Logout
            </button>
        </form>
    </div>
</aside>
