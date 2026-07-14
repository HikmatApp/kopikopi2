@extends('layouts.app')

@section('page-title', 'Data Mitra')
@section('page-subtitle', 'Kelola semua mitra yang terdaftar dalam sistem')

@section('content')

<div class="flex justify-end mb-6">
    <a href="{{ route('admin.dashboard') }}"
       class="bg-gray-900 text-white px-5 py-2.5 rounded-xl shadow hover:bg-black transition text-sm font-medium">
        ← Dashboard
    </a>
</div>

<!-- STATISTIK -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
    <x-stat-card label="Total Mitra" :value="$totalMitra ?? 0" icon="👥" iconBg="bg-gray-100" />
    <x-stat-card label="Mitra Aktif" :value="$mitraAktif ?? 0" icon="✅" iconBg="bg-green-100" />
    <x-stat-card label="Mitra Baru Bulan Ini" :value="$mitraBaruBulanIni ?? 0" icon="🆕" iconBg="bg-blue-100" />
</div>

<!-- SEARCH -->
<form method="GET" action="{{ route('admin.mitra.index') }}" class="mb-5 flex gap-2">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / email..."
        class="w-72 px-4 py-2.5 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm">
    <button type="submit" class="bg-gray-900 text-white px-4 py-2.5 rounded-xl hover:bg-black transition text-sm font-medium">Cari</button>
    <a href="{{ route('admin.mitra.index') }}" class="bg-gray-100 px-4 py-2.5 rounded-xl hover:bg-gray-200 transition text-sm font-medium">Reset</a>
</form>

<!-- TABLE CARD -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left text-sm">
        <thead class="bg-gray-900 text-white">
            <tr>
                <th class="p-4 font-semibold">No</th>
                <th class="p-4 font-semibold">Nama</th>
                <th class="p-4 font-semibold">Email</th>
                <th class="p-4 font-semibold">Status</th>
                <th class="p-4 font-semibold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($mitra as $item)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-4 text-gray-500">{{ $loop->iteration }}</td>
                <td class="p-4 font-semibold text-gray-800">{{ $item->name ?? $item->nama ?? '-' }}</td>
                <td class="p-4 text-gray-600">{{ $item->email ?? '-' }}</td>
                <td class="p-4">
                    @if(($item->is_active ?? 0) == 1)
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                    @else
                        <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">Non Aktif</span>
                    @endif
                </td>
                <td class="p-4">
                    <div class="flex gap-2 justify-center">
                        <a href="{{ route('admin.mitra.show', $item->id) }}"
                           class="bg-blue-500 text-white px-3 py-1.5 rounded-lg hover:bg-blue-600 transition text-xs font-medium">Detail</a>

                        <form action="{{ route('admin.mitra.toggle', $item->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            @if($item->is_active)
                                <button type="submit" class="bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 transition text-xs font-medium">Non Aktif</button>
                            @else
                                <button type="submit" class="bg-green-500 text-white px-3 py-1.5 rounded-lg hover:bg-green-600 transition text-xs font-medium">Aktif</button>
                            @endif
                        </form>

                        <form action="{{ route('admin.mitra.delete', $item->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin hapus mitra ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gray-800 text-white px-3 py-1.5 rounded-lg hover:bg-black transition text-xs font-medium">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="p-8 text-center text-gray-400">Tidak ada data mitra</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
