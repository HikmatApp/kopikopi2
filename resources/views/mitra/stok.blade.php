@extends('layouts.app')

@section('page-title', 'Katalog Stok Barang')
@section('page-subtitle', 'Pilih barang yang ingin dipesan')

@section('content')

<div class="bg-white rounded-2xl shadow border border-gray-100 p-5 mb-6">

    <form method="GET">

        <div class="flex gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari barang..."
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-400 outline-none">

            <button
                class="bg-orange-500 hover:bg-orange-600 text-white px-6 rounded-xl">

                Cari

            </button>

        </div>

    </form>

</div>

<div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="px-5 py-4 text-left">
                    Nama Barang
                </th>

                <th class="px-5 py-4 text-left">
                    Kategori
                </th>

                <th class="px-5 py-4 text-left">
                    Harga
                </th>

                <th class="px-5 py-4 text-center">
                    Stok
                </th>

                <th class="px-5 py-4 text-center">
                    Satuan
                </th>

                <th class="px-5 py-4 text-center">
                    Status
                </th>

                <th class="px-5 py-4 text-center">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($barang as $b)

            <tr class="border-t hover:bg-orange-50">

                <td class="px-5 py-4 font-semibold">

                    {{ $b->nama_barang }}

                </td>

                <td class="px-5 py-4">

                    {{ $b->kategori }}

                </td>

                <td class="px-5 py-4 text-green-600 font-bold">

                    Rp {{ number_format($b->harga_beli * 1.2,0,',','.') }}

                </td>

                <td class="px-5 py-4 text-center">

                    {{ $b->stok }}

                </td>

                <td class="px-5 py-4 text-center">

                    {{ $b->satuan }}

                </td>

                <td class="px-5 py-4 text-center">

                    <span class="px-3 py-1 rounded-full text-xs {{ $b->status_badge }}">

                        {{ $b->status }}

                    </span>

                </td>

                <td class="px-5 py-4 text-center">

                    @if($b->stok > 0)

                    <a
                        href="{{ route('pemesanan.create',['barang'=>$b->id]) }}"
                        class="inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg">

                        Pesan

                    </a>

                    @else

                    <button
                        disabled
                        class="px-4 py-2 bg-gray-300 rounded-lg text-white cursor-not-allowed">

                        Habis

                    </button>

                    @endif

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7" class="text-center py-10 text-gray-400">

                    Belum ada stok barang.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection