@extends('layouts.app')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang di Dashboard Admin KopiKopi')

@section('content')

<!-- HERO BANNER -->
<div class="bg-slate-700 rounded-2xl p-8 mb-6 text-white">
    <h2 class="text-2xl font-bold">Selamat Datang, {{ auth()->user()->name }} 👋</h2>
    <p class="text-slate-300 mt-2">Kelola seluruh aktivitas KopiKopi mulai dari mitra, stok barang, kas, hingga pemesanan.</p>
</div>

<!-- STAT CARDS -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
    <x-stat-card label="Total Mitra" :value="$totalMitra" icon="👥" iconBg="bg-violet-100" />
    <x-stat-card label="Total Barang" :value="$totalBarang" icon="📦" iconBg="bg-amber-100" />
    <x-stat-card label="Barang Menipis" :value="$barangMenipis" icon="⚠️" iconBg="bg-rose-100" />
    <x-stat-card label="Pesanan Pending" :value="$pesananPending" icon="🛒" iconBg="bg-blue-100" />
    <x-stat-card label="Saldo Kas" :value="'Rp ' . number_format($saldoKas, 0, ',', '.')" icon="💰" iconBg="bg-green-100" />
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- AKTIVITAS TERBARU -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-800 mb-4">📋 Aktivitas Terbaru</h3>

        <div class="space-y-4">
            @if ($pesananPending > 0)
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center shrink-0">🛒</div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Pesanan Baru</p>
                        <p class="text-gray-500 text-sm">Ada {{ $pesananPending }} pesanan menunggu diproses.</p>
                    </div>
                </div>
            @else
                <p class="text-gray-400 text-sm">Belum ada pesanan baru.</p>
            @endif

            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-full bg-green-100 flex items-center justify-center shrink-0">✅</div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm">Mitra Aktif</p>
                    <p class="text-gray-500 text-sm">Saat ini terdapat {{ $totalMitra }} mitra terdaftar.</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-full {{ $barangMenipis > 0 ? 'bg-rose-100' : 'bg-gray-100' }} flex items-center justify-center shrink-0">📦</div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm">Stok Barang</p>
                    <p class="text-gray-500 text-sm">Ada {{ $barangMenipis }} barang perlu diperhatikan.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- RINGKASAN SISTEM -->
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-4">📈 Ringkasan Sistem</h3>
            <dl class="space-y-3 text-sm">
                <div class="flex justify-between"><dt class="text-gray-500">Total Mitra</dt><dd class="font-semibold text-gray-800">{{ $totalMitra }}</dd></div>
                <div class="flex justify-between"><dt class="text-gray-500">Total Barang</dt><dd class="font-semibold text-gray-800">{{ $totalBarang }}</dd></div>
                <div class="flex justify-between"><dt class="text-gray-500">Pesanan Pending</dt><dd class="font-semibold text-blue-600">{{ $pesananPending }}</dd></div>
                <div class="flex justify-between"><dt class="text-gray-500">Saldo Kas</dt><dd class="font-semibold {{ $saldoKas >= 0 ? 'text-green-600' : 'text-red-600' }}">Rp {{ number_format($saldoKas, 0, ',', '.') }}</dd></div>
            </dl>
        </div>

        <div class="bg-slate-700 rounded-2xl p-6 text-white">
            <h3 class="font-bold mb-1">{{ $barangMenipis > 0 ? '⚠️ Perhatian' : '✅ Semua Normal' }}</h3>
            <p class="text-slate-300 text-sm">
                {{ $barangMenipis > 0 ? "Ada $barangMenipis barang yang stoknya menipis atau habis." : 'Semua sistem berjalan normal.' }}
            </p>
        </div>
    </div>
</div>

@endsection
