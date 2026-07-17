@extends('layouts.app')

@section('page-title', 'Pembayaran Pesanan')
@section('page-subtitle', 'Lengkapi data pembayaran sebelum mengirim pesanan')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-2xl shadow border border-gray-200 overflow-hidden">

        <div class="bg-orange-500 text-white px-6 py-5">

            <h1 class="text-2xl font-bold">
                Pembayaran Pesanan
            </h1>

            <p class="text-orange-100 mt-1">
                Pastikan data pesanan dan pembayaran sudah benar.
            </p>

        </div>

        <form
            action="{{ route('pemesanan.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="p-6 space-y-6">

            @csrf

            @if(session('error'))
            <div class="bg-red-100 text-red-700 border border-red-300 rounded-lg p-4">
                {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">

                <ul class="list-disc ml-5 text-red-600 text-sm">

                    @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>
            @endif

            <input
                type="hidden"
                name="stok_barang_id"
                value="{{ $barang->id }}">

            <!-- ========================= -->
            <!-- DATA BARANG -->
            <!-- ========================= -->

            <div class="border rounded-xl p-6">

                <h2 class="font-bold text-xl mb-5">

                    Detail Barang

                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="block text-sm font-semibold text-gray-600 mb-2">
                            Nama Barang
                        </label>

                        <input
                            type="text"
                            readonly
                            value="{{ $barang->nama_barang }}"
                            class="w-full rounded-xl border bg-gray-100 px-4 py-3">

                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-gray-600 mb-2">
                            Harga
                        </label>

                        <input
                            type="text"
                            readonly
                            value="Rp {{ number_format($hargaJual,0,',','.') }}"
                            class="w-full rounded-xl border bg-gray-100 px-4 py-3">

                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-gray-600 mb-2">
                            Jumlah
                        </label>

                        <input
                            id="jumlah"
                            name="jumlah"
                            type="number"
                            min="1"
                            max="{{ $barang->stok }}"
                            value="{{ old('jumlah',1) }}"
                            class="w-full rounded-xl border px-4 py-3"
                            required>

                        <small class="text-gray-500">

                            Stok tersedia :
                            {{ $barang->stok }}
                            {{ $barang->satuan }}

                        </small>

                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-gray-600 mb-2">
                            Total Pembayaran
                        </label>

                        <input
                            id="total"
                            readonly
                            value="Rp {{ number_format($hargaJual,0,',','.') }}"
                            class="w-full rounded-xl border bg-gray-100 px-4 py-3">

                    </div>

                </div>

            </div>
            <!-- ========================= -->
            <!-- DATA PENERIMA -->
            <!-- ========================= -->

            <div class="border rounded-xl p-6">

                <h2 class="font-bold text-xl mb-5">

                    Data Penerima

                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="block text-sm font-semibold text-gray-600 mb-2">
                            Nama Penerima
                        </label>

                        <input
                            type="text"
                            name="nama_penerima"
                            value="{{ old('nama_penerima') }}"
                            required
                            class="w-full rounded-xl border px-4 py-3">

                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-gray-600 mb-2">
                            No HP
                        </label>

                        <input
                            type="text"
                            name="no_hp"
                            value="{{ old('no_hp') }}"
                            required
                            class="w-full rounded-xl border px-4 py-3">

                    </div>

                </div>

                <div class="mt-6">

                    <label class="block text-sm font-semibold text-gray-600 mb-2">
                        Alamat Lengkap
                    </label>

                    <textarea
                        name="alamat"
                        rows="4"
                        required
                        class="w-full rounded-xl border px-4 py-3">{{ old('alamat') }}</textarea>

                </div>

            </div>

            <!-- ========================= -->
            <!-- PEMBAYARAN -->
            <!-- ========================= -->

            <div class="border rounded-xl p-6">

                <h2 class="font-bold text-xl mb-5">

                    Metode Pembayaran

                </h2>

                <div class="space-y-4">

                    <label class="flex items-start gap-4 border rounded-xl p-4 cursor-pointer hover:border-orange-500">

                        <input
                            type="radio"
                            name="metode_pembayaran"
                            value="BRI"
                            checked>

                        <div>

                            <div class="font-bold">
                                Bank BRI
                            </div>

                            <div class="text-gray-500 text-sm mt-1">

                                No Rekening

                            </div>

                            <div class="font-semibold text-orange-600">

                                00639821093805

                            </div>

                        </div>

                    </label>

                    <label class="flex items-start gap-4 border rounded-xl p-4 cursor-pointer hover:border-orange-500">

                        <input
                            type="radio"
                            name="metode_pembayaran"
                            value="DANA">

                        <div>

                            <div class="font-bold">

                                DANA

                            </div>

                            <div class="text-gray-500 text-sm mt-1">

                                Nomor DANA

                            </div>

                            <div class="font-semibold text-orange-600">

                                0895385486145

                            </div>

                        </div>

                    </label>

                </div>

                <div class="mt-6">

                    <label class="block text-sm font-semibold text-gray-600 mb-2">

                        Upload Bukti Transfer

                    </label>

                    <input
                        type="file"
                        name="bukti_pembayaran"
                        accept=".jpg,.jpeg,.png"
                        required
                        class="w-full rounded-xl border px-4 py-3">

                </div>

                <div class="mt-6">

                    <label class="block text-sm font-semibold text-gray-600 mb-2">

                        Catatan (Opsional)

                    </label>

                    <textarea
                        name="catatan"
                        rows="3"
                        class="w-full rounded-xl border px-4 py-3">{{ old('catatan') }}</textarea>

                </div>

            </div>
            <div class="flex justify-end gap-3">

                <a
                    href="{{ route('mitra.stok') }}"
                    class="px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300 transition">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-orange-500 hover:bg-orange-600 text-white font-semibold transition">

                    Kirim Pesanan

                </button>

            </div>

        </form>

    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const jumlah = document.getElementById('jumlah');
        const total = document.getElementById('total');

        // Ambil nilai dari Laravel
        const harga = Number(@json($hargaJual));
        const stok = Number(@json($barang->stok));

        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        function hitungTotal() {

            let qty = parseInt(jumlah.value);

            if (isNaN(qty) || qty < 0) {
                qty = 1;
                jumlah.value = 0;
            }

            if (qty > stok) {
                qty = stok;
                jumlah.value = stok;
            }

            const hasil = qty * harga;

            total.value = formatRupiah(hasil);
        }

        jumlah.addEventListener('keyup', hitungTotal);
        jumlah.addEventListener('change', hitungTotal);
        jumlah.addEventListener('input', hitungTotal);

        hitungTotal();

    });
</script>
@endsection