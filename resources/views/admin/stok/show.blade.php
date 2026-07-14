@extends('layouts.app')

@section('page-title', 'Detail Barang')
@section('page-subtitle', $barang->nama_barang)

@section('content')

<div class="flex justify-end mb-5">
    <a href="{{ route('admin.stok.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2.5 rounded-xl text-sm font-medium transition">‹ Kembali</a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <div class="bg-slate-700 p-6 text-white flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold">{{ $barang->nama_barang }}</h2>
            <p class="text-slate-300 text-sm">{{ $barang->kategori }}</p>
        </div>
        <span class="px-3 py-1.5 rounded-full text-sm font-medium {{ $barang->status_badge }}">{{ $barang->status }}</span>
    </div>

    <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-gray-50 rounded-xl p-4">
            <p class="text-xs text-gray-500">Stok Saat Ini</p>
            <p class="text-lg font-bold text-gray-800 mt-1">{{ $barang->stok }} {{ $barang->satuan }}</p>
        </div>
        <div class="bg-gray-50 rounded-xl p-4">
            <p class="text-xs text-gray-500">Stok Minimum</p>
            <p class="text-lg font-bold text-gray-800 mt-1">{{ $barang->stok_minimum }} {{ $barang->satuan }}</p>
        </div>
        <div class="bg-gray-50 rounded-xl p-4">
            <p class="text-xs text-gray-500">Terakhir Diperbarui</p>
            <p class="text-lg font-bold text-gray-800 mt-1">{{ $barang->updated_at->format('d M Y') }}</p>
        </div>
    </div>
</div>

<!-- RIWAYAT STOK -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="font-bold text-gray-800">📜 Riwayat Pergerakan Stok (20 terakhir)</h3>
    </div>

    @if ($riwayat->isEmpty())
        <p class="p-6 text-gray-400 text-sm">Belum ada riwayat pergerakan untuk barang ini.</p>
    @else
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-600 text-left">
                <tr>
                    <th class="px-6 py-3 font-semibold">Tanggal</th>
                    <th class="px-6 py-3 font-semibold">Jenis</th>
                    <th class="px-6 py-3 font-semibold">Jumlah</th>
                    <th class="px-6 py-3 font-semibold">Stok Sebelum → Sesudah</th>
                    <th class="px-6 py-3 font-semibold">Oleh</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($riwayat as $r)
                    <tr>
                        <td class="px-6 py-3 text-gray-500">{{ $r->created_at->format('d M Y H:i') }}</td>
                        <td class="px-6 py-3">
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $r->jenis == 'masuk' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($r->jenis) }}
                            </span>
                        </td>
                        <td class="px-6 py-3">{{ $r->jumlah }}</td>
                        <td class="px-6 py-3 text-gray-600">{{ $r->stok_sebelum }} → {{ $r->stok_sesudah }}</td>
                        <td class="px-6 py-3 text-gray-500">{{ $r->user->name ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
