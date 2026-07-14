@extends('layouts.app')

@section('page-title', 'Laporan Pesanan Saya')
@section('page-subtitle', 'Riwayat pesanan stok yang pernah Anda buat')

@section('content')
<div class="print:bg-white">

    <div class="flex justify-end gap-3 mb-2 print:hidden">
        <button onclick="window.print()" class="bg-gray-900 hover:bg-black text-white px-4 py-2.5 rounded-xl text-sm font-medium transition">🖨️ Cetak</button>
        <a href="{{ route('laporan.export', request()->query()) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium transition">⬇️ Export Excel</a>
    </div>

    <p class="text-xs text-gray-400 mb-5 print:hidden">
        Laporan ini hanya menampilkan pesanan milik akun Anda sendiri. Anda tidak dapat melihat atau mengekspor data pesanan mitra lain.
    </p>

    <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-4 mb-5 print:hidden">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs text-gray-500 mb-1">Dari Tanggal</label>
                <input type="date" name="dari" value="{{ $dari }}" class="border border-gray-200 rounded-xl px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Sampai Tanggal</label>
                <input type="date" name="sampai" value="{{ $sampai }}" class="border border-gray-200 rounded-xl px-3 py-2 text-sm">
            </div>
            <button type="submit" class="bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-xl text-sm transition">Filter</button>
            <a href="{{ route('laporan.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm transition">Reset</a>
        </form>
    </div>

    <div class="hidden print:block text-center mb-6">
        <h1 class="text-xl font-bold">Laporan Pesanan - {{ auth()->user()->name }}</h1>
        <p class="text-sm">Periode: {{ $dari ?: 'Semua' }} s/d {{ $sampai ?: 'Semua' }}</p>
    </div>

    <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden print:border print:shadow-none">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-4 font-semibold">Tanggal</th>
                    <th class="p-4 font-semibold">Barang</th>
                    <th class="p-4 font-semibold">Jumlah</th>
                    <th class="p-4 font-semibold">Status</th>
                    <th class="p-4 font-semibold">Catatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($pemesanan as $p)
                <tr>
                    <td class="p-4 text-gray-600">{{ $p->created_at->format('d M Y H:i') }}</td>
                    <td class="p-4 text-gray-700">{{ $p->barang->nama_barang ?? '-' }}</td>
                    <td class="p-4 text-gray-600">{{ $p->jumlah }}</td>
                    <td class="p-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $p->status_badge }}">{{ ucfirst($p->status) }}</span></td>
                    <td class="p-4 text-gray-500">{{ $p->catatan ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-8 text-center text-gray-400">Belum ada pesanan pada periode ini</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
