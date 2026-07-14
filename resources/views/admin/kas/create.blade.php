@extends('layouts.app')
@php $isMasuk = $jenis === 'masuk'; @endphp

@section('page-title', 'Tambah Transaksi')
@section('page-subtitle', 'Catat transaksi ' . ($isMasuk ? 'kas masuk' : 'kas keluar'))

@section('content')
<div class="max-w-xl bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <h1 class="text-xl font-bold text-gray-800">Tambah Transaksi</h1>
    </div>

    <form action="{{ route('admin.kas.store', $jenis) }}" method="POST" class="p-6 space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Jenis Transaksi</label>
            <select disabled class="w-full border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50 text-gray-500">
                <option>{{ $isMasuk ? 'Kas Masuk' : 'Kas Keluar' }}</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
            @error('tanggal') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Keterangan</label>
            <input type="text" name="keterangan" value="{{ old('keterangan') }}" required
                placeholder="{{ $isMasuk ? 'Contoh: Penjualan harian' : 'Contoh: Beli bahan baku' }}"
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
            @error('keterangan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nominal (Rp)</label>
            <input type="number" name="nominal" min="1" value="{{ old('nominal') }}" required
                placeholder="Contoh: 100000"
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
            @error('nominal') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('admin.kas.index', $jenis) }}" class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 transition">Batal</a>
            <button type="submit" class="px-5 py-2.5 rounded-xl {{ $isMasuk ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }} text-white font-semibold transition">Simpan</button>
        </div>
    </form>
</div>
@endsection
