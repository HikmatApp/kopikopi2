@extends('layouts.app')

@section('page-title', 'Laporan')
@section('page-subtitle', 'Laporan arus kas & pergerakan stok UMKM KopiKopi')

@section('content')
<div class="print:bg-white">

    <div class="flex justify-end gap-3 mb-5 print:hidden">
        <button onclick="window.print()" class="bg-gray-900 hover:bg-black text-white px-4 py-2.5 rounded-xl text-sm font-medium transition">🖨️ Cetak</button>
        <a href="{{ route('laporan.export', request()->query()) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium transition">⬇️ Export Excel</a>
    </div>

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
        <h1 class="text-xl font-bold">Laporan UMKM KopiKopi</h1>
        <p class="text-sm">Periode: {{ $dari ?: 'Semua' }} s/d {{ $sampai ?: 'Semua' }}</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
        <div class="bg-green-50 border border-green-100 rounded-2xl p-5">
            <p class="text-sm text-green-700">Total Cash In</p>
            <h2 class="text-2xl font-bold text-green-600 mt-1">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</h2>
        </div>
        <div class="bg-red-50 border border-red-100 rounded-2xl p-5">
            <p class="text-sm text-red-700">Total Cash Out</p>
            <h2 class="text-2xl font-bold text-red-600 mt-1">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</h2>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-5">
            <p class="text-sm text-gray-500">Saldo</p>
            <h2 class="text-2xl font-bold {{ $saldo >= 0 ? 'text-gray-800' : 'text-red-600' }} mt-1">Rp {{ number_format($saldo, 0, ',', '.') }}</h2>
        </div>
    </div>

    <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden mb-6 print:border print:shadow-none">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-800">Riwayat Transaksi Kas</h3>
            <p class="text-sm text-gray-400">Seluruh transaksi Cash In dan Cash Out.</p>
        </div>
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-4 font-semibold">Tanggal</th>
                    <th class="p-4 font-semibold">Jenis</th>
                    <th class="p-4 font-semibold">Keterangan</th>
                    <th class="p-4 font-semibold">Nominal</th>
                    <th class="p-4 font-semibold">Dicatat Oleh</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($kas as $k)
                <tr>
                    <td class="p-4 text-gray-600">{{ $k->tanggal->format('d M Y') }}</td>
                    <td class="p-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $k->jenis == 'masuk' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ ucfirst($k->jenis) }}</span>
                    </td>
                    <td class="p-4 text-gray-700">{{ $k->keterangan }}</td>
                    <td class="p-4 font-medium text-gray-800">{{ $k->nominal_format }}</td>
                    <td class="p-4 text-gray-500">{{ $k->user->name ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-8 text-center text-gray-400">Tidak ada transaksi pada periode ini</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden print:border print:shadow-none">
        <div class="px-6 py-4 border-b border-gray-100"><h3 class="font-bold text-gray-800">Riwayat Pergerakan Stok</h3></div>
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-4 font-semibold">Tanggal</th>
                    <th class="p-4 font-semibold">Barang</th>
                    <th class="p-4 font-semibold">Jenis</th>
                    <th class="p-4 font-semibold">Jumlah</th>
                    <th class="p-4 font-semibold">Oleh</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($riwayatStok as $r)
                <tr>
                    <td class="p-4 text-gray-600">{{ $r->created_at->format('d M Y') }}</td>
                    <td class="p-4 text-gray-700">{{ $r->barang->nama_barang ?? '-' }}</td>
                    <td class="p-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $r->jenis == 'masuk' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ ucfirst($r->jenis) }}</span>
                    </td>
                    <td class="p-4 text-gray-600">{{ $r->jumlah }}</td>
                    <td class="p-4 text-gray-500">{{ $r->user->name ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-8 text-center text-gray-400">Tidak ada pergerakan stok pada periode ini</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
