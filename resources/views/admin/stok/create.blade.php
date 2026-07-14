@extends('layouts.app')

@section('page-title', 'Tambah Barang')
@section('page-subtitle', 'Tambahkan data barang baru ke sistem')

@section('content')
<div class="max-w-xl bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-indigo-600 to-indigo-500 px-6 py-6 text-white">
        <h1 class="text-xl font-bold">Tambah Barang</h1>
        <p class="text-sm text-indigo-100 mt-1">Isi data stok barang untuk menambahkan ke sistem inventori</p>
    </div>

    <form action="{{ route('admin.stok.store') }}" method="POST" class="p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Barang</label>
            <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" required
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 outline-none">
            @error('nama_barang') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori</label>
                <input type="text" name="kategori" value="{{ old('kategori') }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Satuan</label>
                <input type="text" name="satuan" value="{{ old('satuan') }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Stok</label>
                <input type="number" name="stok" min="0" value="{{ old('stok', 0) }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Stok Minimum</label>
                <input type="number" name="stok_minimum" min="0" value="{{ old('stok_minimum', 10) }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('admin.stok.index') }}" class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 transition">Batal</a>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
