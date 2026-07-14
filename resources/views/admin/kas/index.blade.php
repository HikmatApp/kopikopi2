@extends('layouts.app')

@section('page-title', 'Dashboard Keuangan')
@section('page-subtitle', 'Monitoring pemasukan, pengeluaran dan saldo UMKM KopiKopi')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex flex-col md:flex-row justify-between md:items-center gap-4">

        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Dashboard Keuangan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Semua transaksi kas masuk dan kas keluar ditampilkan dalam satu halaman.
            </p>
        </div>

        <div class="flex gap-3">

            <a href="{{ route('admin.dashboard') }}"
                class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium transition">
                ← Kembali
            </a>

            <a href="{{ route('admin.kas.create','masuk') }}"
                class="px-5 py-2.5 rounded-xl bg-green-500 hover:bg-green-600 text-white font-semibold transition">
                + Kas Masuk
            </a>

            <a href="{{ route('admin.kas.create','keluar') }}"
                class="px-5 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white font-semibold transition">
                + Kas Keluar
            </a>

        </div>

    </div>


    {{-- RINGKASAN --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        {{-- Kas Masuk --}}
        <div class="bg-green-50 border border-green-200 rounded-2xl p-6">

            <p class="text-sm text-green-700">
                Total Kas Masuk
            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">
                Rp {{ number_format($totalKasMasuk,0,',','.') }}
            </h2>

            <p class="text-xs text-green-600 mt-2">
                Total seluruh pemasukan.
            </p>

        </div>


        {{-- Kas Keluar --}}
        <div class="bg-red-50 border border-red-200 rounded-2xl p-6">

            <p class="text-sm text-red-700">
                Total Kas Keluar
            </p>

            <h2 class="text-3xl font-bold text-red-600 mt-2">
                Rp {{ number_format($totalKasKeluar,0,',','.') }}
            </h2>

            <p class="text-xs text-red-600 mt-2">
                Total seluruh pengeluaran.
            </p>

        </div>


        {{-- Saldo --}}
        <div class="rounded-2xl p-6 border
            @if($saldoKas >= 0)
                bg-blue-50 border-blue-200
            @else
                bg-yellow-50 border-yellow-200
            @endif">

            <p class="text-sm text-gray-600">
                Saldo Saat Ini
            </p>

            <h2 class="text-3xl font-bold
                @if($saldoKas >= 0)
                    text-blue-600
                @else
                    text-red-600
                @endif">

                Rp {{ number_format($saldoKas,0,',','.') }}

            </h2>

            @if($saldoKas >= 0)

                <p class="text-xs text-blue-600 mt-2">
                    Kondisi keuangan masih surplus.
                </p>

            @else

                <p class="text-xs text-red-600 mt-2">
                    Pengeluaran lebih besar daripada pemasukan.
                </p>

            @endif

        </div>

    </div>


    {{-- FILTER --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">

        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">

            <div>
                <label class="block text-sm text-gray-600 mb-1">
                    Dari Tanggal
                </label>

                <input
                    type="date"
                    name="dari"
                    value="{{ request('dari') }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2">
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">
                    Sampai Tanggal
                </label>

                <input
                    type="date"
                    name="sampai"
                    value="{{ request('sampai') }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2">
            </div>

            <div>

                <label class="block text-sm text-gray-600 mb-1">
                    Jenis Transaksi
                </label>

                <select
                    name="filter_jenis"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2">

                    <option value="">
                        Semua Transaksi
                    </option>

                    <option value="masuk"
                        {{ request('filter_jenis') == 'masuk' ? 'selected' : '' }}>
                        Kas Masuk
                    </option>

                    <option value="keluar"
                        {{ request('filter_jenis') == 'keluar' ? 'selected' : '' }}>
                        Kas Keluar
                    </option>

                </select>

            </div>

            <div>

                <button
                    type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white rounded-xl py-2.5 font-semibold">

                    Filter

                </button>

            </div>

            <div>

                <a href="{{ route('admin.kas.index','masuk') }}"
                    class="block text-center bg-gray-200 hover:bg-gray-300 rounded-xl py-2.5">

                    Reset

                </a>

            </div>

        </form>

    </div>


    {{-- RIWAYAT TRANSAKSI --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="px-6 py-5 border-b">

            <h3 class="text-lg font-bold text-gray-800">
                Riwayat Transaksi
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Seluruh transaksi kas masuk dan kas keluar.
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-5 py-4 text-left">Tanggal</th>
                        <th class="px-5 py-4 text-left">Jenis</th>
                        <th class="px-5 py-4 text-left">Keterangan</th>
                        <th class="px-5 py-4 text-right">
    Nominal
</th>

<th class="px-5 py-4 text-center">
    Dicatat Oleh
</th>

<th class="px-5 py-4 text-center">
    Aksi
</th>

</tr>

</thead>

<tbody class="divide-y divide-gray-100">

@forelse($transaksi as $t)

<tr class="hover:bg-gray-50">

    <td class="px-5 py-4">
        {{ $t->tanggal->format('d M Y') }}
    </td>

    <td class="px-5 py-4">

        @if($t->jenis == 'masuk')

            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                Kas Masuk
            </span>

        @else

            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                Kas Keluar
            </span>

        @endif

    </td>

    <td class="px-5 py-4">
        {{ $t->keterangan }}
    </td>

    <td class="px-5 py-4 text-right font-semibold">

        <span class="{{ $t->jenis == 'masuk' ? 'text-green-600' : 'text-red-600' }}">

            {{ $t->jenis == 'masuk' ? '+' : '-' }}
            Rp {{ number_format($t->nominal,0,',','.') }}

        </span>

    </td>

    <td class="px-5 py-4 text-center">
        {{ $t->user->name ?? '-' }}
    </td>

    <td class="px-5 py-4 text-center">

        <form
            action="{{ route('admin.kas.destroy',$t->id) }}"
            method="POST"
            onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">

            @csrf
            @method('DELETE')

            <button
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs">

                Hapus

            </button>

        </form>

    </td>

</tr>

@empty

<tr>

    <td colspan="6" class="px-6 py-8 text-center text-gray-500">

        Belum ada transaksi.

    </td>

</tr>


                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="px-6 py-4 border-t border-gray-100">

            {{ $transaksi->links() }}

        </div>

    </div>

</div>

@endsection