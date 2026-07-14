@extends('layouts.app')

@section('page-title', 'Dashboard Mitra')
@section('page-subtitle', 'Selamat datang di Dashboard Mitra KopiKopi')

@section('content')

<!-- HERO BANNER -->
<div class="bg-orange-500 rounded-2xl p-8 mb-6 text-white">
    <h2 class="text-2xl font-bold">
        Selamat Datang, {{ auth()->user()->name }} 👋
    </h2>

    <p class="text-orange-100 mt-2">
        Kelola aktivitas Anda mulai dari memesan stok hingga melihat riwayat pesanan.
    </p>
</div>

<!-- STAT CARDS -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
    <x-stat-card
        label="Total Pesanan Saya"
        :value="$totalPesanan"
        icon="🧾"
        iconBg="bg-blue-100"
    />

    <x-stat-card
        label="Menunggu Diproses"
        :value="$pesananPending"
        icon="⏳"
        iconBg="bg-amber-100"
    />

    <x-stat-card
        label="Selesai"
        :value="$pesananSelesai"
        icon="✅"
        iconBg="bg-green-100"
    />
</div>

<!-- MENU CEPAT -->
<div class="mb-6">

    <h3 class="font-bold text-gray-800 mb-3">
        ⚡ Menu Cepat
    </h3>

    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">

        <!-- PESAN STOK -->
        <a href="{{ route('mitra.stok') }}"
           class="bg-white hover:shadow-md rounded-2xl border border-gray-100 p-5 text-center transition">

            <div class="text-2xl mb-2">
                🛒
            </div>

            <p class="text-sm font-semibold text-gray-700">
                Pesan Stok
            </p>

        </a>

        <!-- KATALOG STOK -->
        <a href="{{ route('mitra.stok') }}"
           class="bg-white hover:shadow-md rounded-2xl border border-gray-100 p-5 text-center transition">

            <div class="text-2xl mb-2">
                📦
            </div>

            <p class="text-sm font-semibold text-gray-700">
                Katalog Stok
            </p>

        </a>

        <!-- LAPORAN -->
        <a href="{{ route('laporan.index') }}"
           class="bg-white hover:shadow-md rounded-2xl border border-gray-100 p-5 text-center transition">

            <div class="text-2xl mb-2">
                📈
            </div>

            <p class="text-sm font-semibold text-gray-700">
                Laporan Saya
            </p>

        </a>

    </div>

</div>

<!-- PESANAN TERBARU -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">

        <h3 class="font-bold text-gray-800">
            📋 Pesanan Terbaru
        </h3>

        <a href="{{ route('pemesanan.index') }}"
           class="text-sm text-orange-600 hover:underline font-medium">

            Lihat semua →

        </a>

    </div>

    @if ($pesananTerbaru->isEmpty())

        <p class="p-6 text-gray-400 text-sm">
            Belum ada pesanan. Yuk mulai pesan stok pertama Anda.
        </p>

    @else

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-500 text-left">
                <tr>
                    <th class="px-6 py-3 font-semibold">
                        Barang
                    </th>

                    <th class="px-6 py-3 font-semibold">
                        Jumlah
                    </th>

                    <th class="px-6 py-3 font-semibold">
                        Status
                    </th>

                    <th class="px-6 py-3 font-semibold">
                        Tanggal
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

                @foreach ($pesananTerbaru as $p)

                    <tr>

                        <td class="px-6 py-3 font-medium text-gray-700">
                            {{ $p->barang->nama_barang ?? '-' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $p->jumlah }}
                        </td>

                        <td class="px-6 py-3">
                            <span class="px-2 py-1 rounded-full text-xs {{ $p->status_badge }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>

                        <td class="px-6 py-3 text-gray-500">
                            {{ $p->created_at->format('d M Y') }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @endif

</div>

@endsection