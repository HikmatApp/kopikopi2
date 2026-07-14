@extends('layouts.app')

@section('page-title', 'Detail Mitra')
@section('page-subtitle', 'Informasi lengkap data mitra')

@section('content')

<div class="flex justify-end mb-6">
    <a href="{{ route('admin.mitra.index') }}"
        class="bg-gray-900 text-white px-5 py-2.5 rounded-xl shadow hover:bg-black transition text-sm font-medium">
        ← Kembali
    </a>
</div>

<div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="bg-gray-900 p-6 text-white">
        <h2 class="text-xl font-bold">{{ $mitra->name ?? $mitra->nama ?? 'Tanpa Nama' }}</h2>
        <p class="text-gray-300 text-sm">{{ $mitra->email ?? '-' }}</p>
    </div>

    <div class="p-6 space-y-4">
        <div class="flex justify-between items-center">
            <span class="text-gray-600 font-medium">Status</span>
            @if(($mitra->is_active ?? 0) == 1)
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">Aktif</span>
            @else
                <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full text-sm">Non Aktif</span>
            @endif
        </div>

        <div class="flex justify-between items-center border-t pt-4">
            <span class="text-gray-600 font-medium">Email</span>
            <span class="text-gray-800">{{ $mitra->email ?? '-' }}</span>
        </div>

        <div class="flex justify-between items-center border-t pt-4">
            <span class="text-gray-600 font-medium">Nama Lengkap</span>
            <span class="text-gray-800 font-semibold">{{ $mitra->name ?? $mitra->nama ?? '-' }}</span>
        </div>

        <div class="flex justify-between items-center border-t pt-4">
            <span class="text-gray-600 font-medium">Terdaftar</span>
            <span class="text-gray-800">{{ $mitra->created_at ? $mitra->created_at->format('d M Y') : '-' }}</span>
        </div>
    </div>
</div>

@endsection
