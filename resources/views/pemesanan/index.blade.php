@extends('layouts.app')

@php
$isAdmin = auth()->user()->isAdmin();
@endphp

@section('page-title', $isAdmin ? 'Data Pemesanan Mitra' : 'Pesanan Saya')
@section('page-subtitle', $isAdmin ? 'Kelola seluruh pemesanan dari mitra' : 'Riwayat pemesanan barang')

@section('content')

@if(session('success'))
<div class="mb-5 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3">
    {{ session('error') }}
</div>
@endif

@unless($isAdmin)

<div class="flex justify-end mb-5">

    <a href="{{ route('mitra.stok') }}"
        class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-xl shadow font-semibold">

        + Pesan Barang

    </a>

</div>

@endunless

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    <table class="w-full text-sm">

        <thead class="bg-gray-100 text-gray-700">

            <tr>

                <th class="px-4 py-3">
                    No
                </th>

                @if($isAdmin)

                <th class="px-4 py-3">
                    Mitra
                </th>

                @endif

                <th class="px-4 py-3">
                    Barang
                </th>

                <th class="px-4 py-3">
                    Qty
                </th>

                <th class="px-4 py-3">
                    Harga
                </th>

                <th class="px-4 py-3">
                    Total
                </th>

                <th class="px-4 py-3">
                    Status
                </th>

                <th class="px-4 py-3">
                    Tanggal
                </th>

                <th class="px-4 py-3 text-center">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody class="divide-y">

            @forelse($pemesanan as $p)

            <tr class="hover:bg-gray-50">

                <td class="px-4 py-3">

                    {{ $loop->iteration + (($pemesanan->currentPage()-1) * $pemesanan->perPage()) }}

                </td>

                @if($isAdmin)

                <td class="px-4 py-3 font-medium">

                    {{ $p->mitra->name }}

                </td>

                @endif

                <td class="px-4 py-3">

                    {{ $p->barang->nama_barang }}

                </td>

                <td class="px-4 py-3">

                    {{ $p->jumlah }}

                </td>

                <td class="px-4 py-3">

                    {{ $p->harga_satuan_format }}

                </td>

                <td class="px-4 py-3 font-semibold text-green-600">

                    {{ $p->total_harga_format }}

                </td>

                <td class="px-4 py-3">
                    @if($isAdmin)

                    <form action="{{ route('admin.pemesanan.status', $p->id) }}"
                        method="POST">

                        @csrf
                        @method('PATCH')

                        <select
                            name="status"
                            onchange="this.form.submit()"
                            class="border rounded-lg px-2 py-1 text-xs">

                            <option value="pending"
                                {{ $p->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="diproses"
                                {{ $p->status == 'diproses' ? 'selected' : '' }}>
                                Diproses
                            </option>

                            <option value="selesai"
                                {{ $p->status == 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>

                            <option value="ditolak"
                                {{ $p->status == 'ditolak' ? 'selected' : '' }}>
                                Ditolak
                            </option>

                        </select>

                    </form>

                    @else

                    <span
                        class="px-2 py-1 rounded-full text-xs font-medium {{ $p->status_badge }}">

                        {{ ucfirst($p->status) }}

                    </span>

                    @endif

                </td>

                <td class="px-4 py-3 text-gray-500">

                    {{ $p->created_at->format('d M Y H:i') }}

                </td>

                <td class="px-4 py-3">

                    <div class="flex items-center gap-2">

                        <a href="{{ route('pemesanan.show', $p->id) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-xs">

                            Detail

                        </a>

                        @if(!$isAdmin && $p->status == 'pending')

                        <form
                            action="{{ route('pemesanan.destroy', $p->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">

                            @csrf
                            @method('DELETE')

                            <button
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs">

                                Hapus

                            </button>

                        </form>

                        @endif

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="{{ $isAdmin ? 9 : 8 }}"
                    class="text-center py-10 text-gray-400">

                    Belum ada data pemesanan.

                </td>

            </tr>
            @endforelse

        </tbody>

    </table>


    <div class="p-4">

        {{ $pemesanan->links() }}

    </div>


</div>


@endsection