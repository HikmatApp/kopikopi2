@extends('layouts.app')

@section('content')

<div class="p-6">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">
            Detail Pesanan
        </h1>

        <a href="{{ route('pemesanan.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            ← Kembali
        </a>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        {{-- ========================= --}}
        {{-- INFORMASI MITRA --}}
        {{-- ========================= --}}

        <h2 class="text-xl font-bold mb-5">
            Informasi Mitra
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <p class="text-gray-500">Nama Mitra</p>
                <p class="font-semibold">
                    {{ $pemesanan->mitra->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Email</p>
                <p class="font-semibold">
                    {{ $pemesanan->mitra->email ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Tanggal Pesanan</p>
                <p class="font-semibold">
                    {{ $pemesanan->created_at->format('d M Y H:i') }}
                </p>
            </div>

            <div>

                <p class="text-gray-500">
                    Status
                </p>

                <span class="px-3 py-1 rounded-full text-sm {{ $pemesanan->status_badge }}">

                    {{ ucfirst($pemesanan->status) }}

                </span>

            </div>

        </div>

        <hr class="my-8">

        {{-- ========================= --}}
        {{-- DATA PENERIMA --}}
        {{-- ========================= --}}

        <h2 class="text-xl font-bold mb-5">

            Data Pengiriman

        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <p class="text-gray-500">
                    Nama Penerima
                </p>

                <p class="font-semibold">
                    {{ $pemesanan->nama_penerima }}
                </p>
            </div>

            <div>

                <p class="text-gray-500">
                    Nomor HP
                </p>

                <p class="font-semibold">
                    {{ $pemesanan->no_hp }}
                </p>

            </div>

            <div class="md:col-span-2">

                <p class="text-gray-500">
                    Alamat Lengkap
                </p>

                <p class="font-semibold whitespace-pre-line">
                    {{ $pemesanan->alamat }}
                </p>

            </div>

            <div class="md:col-span-2">

                <p class="text-gray-500">
                    Catatan
                </p>

                <p class="font-semibold">
                    {{ $pemesanan->catatan ?: '-' }}
                </p>

            </div>

        </div>

        <hr class="my-8">

        {{-- ========================= --}}
        {{-- DETAIL BARANG --}}
        {{-- ========================= --}}

        <h2 class="text-xl font-bold mb-5">

            Detail Barang

        </h2>

        <div class="overflow-x-auto">

            <table class="w-full border">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="border p-3">
                            Barang
                        </th>

                        <th class="border p-3">
                            Jumlah
                        </th>

                        <th class="border p-3">
                            Harga Satuan
                        </th>

                        <th class="border p-3">
                            Total
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td class="border p-3">

                            {{ $pemesanan->barang->nama_barang ?? '-' }}

                        </td>

                        <td class="border p-3 text-center">

                            {{ $pemesanan->jumlah }}

                        </td>

                        <td class="border p-3">

                            {{ $pemesanan->harga_satuan_format }}

                        </td>

                        <td class="border p-3 font-bold">

                            {{ $pemesanan->total_harga_format }}

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

        <hr class="my-8">

        {{-- ========================= --}}
        {{-- PEMBAYARAN --}}
        {{-- ========================= --}}

        <h2 class="text-xl font-bold mb-5">

            Pembayaran

        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">

            <div>

                <p class="text-gray-500">
                    Metode Pembayaran
                </p>

                <p class="font-semibold">

                    {{ $pemesanan->metode_pembayaran_text }}

                </p>

            </div>

            <div>

                <p class="text-gray-500">
                    Nomor Pembayaran
                </p>

                <p class="font-semibold">

                    {{ $pemesanan->nomor_pembayaran }}

                </p>

            </div>

        </div>

        @if($pemesanan->bukti_pembayaran)

            <img
    src="{{ asset('storage/' . $pemesanan->bukti_pembayaran) }}"
    alt="Bukti Pembayaran"
    class="rounded-xl border shadow w-full max-w-md">

        @else

            <div class="bg-gray-100 rounded-lg p-5 text-gray-500">

                Bukti pembayaran belum tersedia.

            </div>

        @endif

        <hr class="my-8">

        <div class="flex justify-end">

            <div class="bg-orange-50 border border-orange-200 rounded-xl px-6 py-4">

                <p class="text-gray-500 text-sm">
                    Total Pembayaran
                </p>

                <h2 class="text-3xl font-bold text-orange-600">

                    {{ $pemesanan->total_harga_format }}

                </h2>

            </div>

        </div>

    </div>

</div>

@endsection