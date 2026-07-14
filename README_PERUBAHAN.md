# KopiKopi - Sistem Informasi Persediaan Barang & Manajemen Arus Kas

## 0. BARU: UI Sidebar Sesuai Wireframe (3.3.6 Perancangan Antarmuka)

Seluruh tampilan sudah dirombak mengikuti gaya wireframe di dokumen referensi
kelompok lain (bagian 3.3.6): **layout sidebar**, bukan navbar atas seperti
versi sebelumnya. Detail:

- **Sidebar Admin**: latar putih, badge "ADMIN PANEL" oranye, menu aktif
  berwarna oranye solid. Menu: Dashboard, Data Mitra, Stok Barang, Pemesanan,
  Kas/Transaksi, Laporan, Kelola User, Profile & Keamanan.
- **Sidebar Mitra**: latar gelap (slate-800), menu: Dashboard, Katalog Stok,
  Pesanan Saya, Laporan Saya, Pengaturan.
- **Warna aksen**: oranye (#F97316), sesuai warna asli wireframe (sempat saya
  kira hijau tua dari kesan visual, ternyata setelah dicek pixel-by-pixel
  warnanya oranye/amber — jadi saya ikuti warna yang benar).
- **Modal Tambah Barang**: header gradient indigo, meniru wireframe.
- **Dashboard Admin**: banner sambutan + kartu statistik + "Aktivitas Terbaru" + "Ringkasan Sistem".
- **Dashboard Mitra**: banner oranye + kartu statistik + "Menu Cepat".
- **Halaman Pengaturan**: gabungan gaya "Edit Profile" (kartu avatar + info akun) dan "Keamanan Akun" (banner oranye + form ganti password).
- Fitur yang tidak ada di sistem KopiKopi kita (seperti "Pengajuan Paket" franchise di dokumen referensi) sengaja **tidak** ditiru — hanya gaya visualnya yang diambil, bukan fitur kemitraan/franchise-nya, karena itu di luar cakupan skripsi ini.
- Route lama `/profile` bawaan Breeze beserta `ProfileController` dan `layouts/navigation.blade.php` (navbar lama) sudah dihapus karena sepenuhnya digantikan halaman Pengaturan.

Sudah diuji ulang end-to-end (login admin+mitra, buka semua halaman, submit
form) setelah redesign ini — semua tetap HTTP 200 tanpa error.

## 1. Sebelumnya: Sudah Diuji Sungguhan (bug route & dependency)
## 0. PENTING - Update Terbaru: Sudah Diuji Sungguhan

Sebelumnya saya hanya menganalisis kode secara manual (baca file satu-satu), dan
itu ternyata tidak cukup — ada bug yang cuma ketahuan kalau aplikasinya benar-benar
dijalankan. Kali ini saya instal PHP, Composer, MySQL/MariaDB, dan Node.js,
lalu **benar-benar menjalankan aplikasinya**: migrate database sungguhan, login
sebagai admin & mitra lewat HTTP request asli, klik/submit semua form, dan cek
setiap halaman tidak error. Ini bug baru yang ketemu & sudah diperbaiki:

### Bug baru yang ditemukan & diperbaiki (dari testing sungguhan)
- **`Route [stok.index] not defined` → error 500 di dashboard admin.** Rute
  stok sebenarnya terdaftar sebagai `admin.stok.index` (karena didaftarkan di
  dalam grup `name('admin.')`), tapi di beberapa file saya masih menulis
  `route('stok.index')` (tanpa awalan `admin.`). Ini bikin **dashboard admin
  langsung error 500 begitu dibuka** — kemungkinan ini yang bikin Anda pusing.
  Sudah diperbaiki di `StokBarangController.php`, `admin/dashboard.blade.php`,
  dan `layouts/navigation.blade.php`.
- **Dependency usang `maatwebsite/excel: ^1.1`** di `composer.json` — ini versi
  purba untuk Laravel 4 (rilis ~2015), tidak dipakai kode manapun, dan berpotensi
  bikin bingung/bentrok. Sudah dihapus dari `composer.json` & `composer.lock`.

### Cara saya memvalidasi (supaya Anda yakin ini beneran jalan)
1. `composer install` sungguhan (bukan cuma baca kode)
2. `npm install && npm run build` — asset Tailwind/Vite sukses ke-build
3. `php artisan migrate:fresh --seed` — dua kali, sekali ke **SQLite**, sekali
   ke **MySQL/MariaDB asli** (bukan XAMPP tapi mesin MySQL yang sama)
4. Login sungguhan lewat HTTP (curl) sebagai **admin** dan sebagai **mitra**,
   lalu buka SATU PER SATU semua halaman: dashboard, stok (index/create/edit/show),
   kas masuk/keluar, mitra, kelola user, laporan, pengaturan, pemesanan —
   semua saya pastikan return HTTP 200, bukan 500/404.
5. Submit form sungguhan: tambah barang, edit stok (cek riwayat_stok otomatis
   tercatat), tambah kas masuk, hapus kas, pesan stok sebagai mitra, ubah status
   pesanan sebagai admin, ganti password, update pengaturan aplikasi.
6. Test keamanan: mitra coba akses `/admin/*` langsung lewat URL → **403**.
   Mitra kedua coba hapus pesanan mitra pertama → **403**, data tidak terhapus.
   Akun dinonaktifkan admin → **login ditolak**. Admin coba turunkan role
   sendiri → **ditolak**.
7. Generate SQL dump asli dari database yang sudah ter-migrasi dengan benar
   (lihat bagian 2 di bawah), lalu import ulang ke database kosong untuk
   memastikan file `.sql`-nya valid dan `php artisan migrate` tidak bentrok
   setelahnya.

Semua di atas **lolos** setelah perbaikan bug route di atas.

## 1. File SQL untuk phpMyAdmin/XAMPP (BARU)

Sekarang ada file **`database/sql/kopikopi.sql`** — hasil generate langsung dari
database yang sudah ter-migrasi dengan benar (bukan ditulis manual). Ini bisa
langsung di-import lewat phpMyAdmin, sebagai alternatif dari `php artisan migrate --seed`.

**Cara pakai:**
1. Buka phpMyAdmin (`http://localhost/phpmyadmin`)
2. Buat database baru bernama **`kopikopi`**
3. Klik database `kopikopi` → tab **Import** → pilih file `database/sql/kopikopi.sql` → **Go**
4. Selesai — semua tabel + akun admin & mitra contoh otomatis terisi.

Sudah divalidasi: kalau nanti Anda tambah migration baru dan jalankan
`php artisan migrate`, Laravel akan bilang **"Nothing to migrate"** (tidak bentrok),
karena tabel `migrations` di dalam file SQL ini sudah diisi dengan benar.

**Pilih SALAH SATU saja**, jangan dua-duanya:
- **Opsi A (SQL manual):** import `database/sql/kopikopi.sql` lewat phpMyAdmin
- **Opsi B (via Laravel):** `php artisan migrate --seed`

## 2. Ringkasan Perubahan (dari sesi sebelumnya, masih berlaku)

### Bug yang diperbaiki
- **`role` & `is_active` tidak ada di `$fillable` User model** — ini penyebab akun
  admin hasil seeder ikut ter-set jadi `role: mitra` secara diam-diam. Sudah
  ditambahkan ke `$fillable`.
- **Route `/admin/transaksi` menunjuk ke view yang tidak ada** — dihapus, diganti
  fitur Kas (lihat di bawah).
- **`cash_in.blaed.php`** (typo ekstensi, harusnya `.blade.php`) dan beberapa view
  kosong (`cash_out`, `laporan`, `user`, `mitra/pemasanan`, `mitra/profile`,
  `mitra/stok`) — dihapus/diganti dengan implementasi asli.
- **Dashboard mitra pakai data hardcode** ("170 Cup", "Paket A") — sekarang
  ambil data asli dari database.
- **Tidak ada proteksi role di route admin** — ditambahkan middleware `role:admin`
  / `role:mitra`.
- **File view duplikat/orphan** (`admin/mitra.blade.php`, `admin/stok.blade.php`)
  — dihapus karena tidak dipakai controller manapun.
- **Registrasi publik bisa jadi role apapun** — sekarang dipaksa selalu `mitra`.
- **Login tidak mengecek `is_active`** — sekarang akun yang dinonaktifkan admin
  tidak bisa login.

### Fitur baru yang ditambahkan
| Fitur | Admin | Mitra |
|---|---|---|
| Dashboard (data asli, bukan hardcode) | ✅ | ✅ |
| Stok Barang (CRUD + riwayat pergerakan otomatis) | ✅ kelola penuh | 👁️ lihat saja (katalog) |
| Notifikasi stok menipis/habis (badge di navbar & dashboard) | ✅ | - |
| Kas Masuk / Kas Keluar | ✅ | - |
| Pemesanan Stok | kelola status pesanan semua mitra | buat & lihat pesanan sendiri |
| Laporan — bisa **cetak** & **export** | ✅ semua data | ✅ **hanya data milik sendiri** |
| Kelola User (ubah role, aktif/nonaktifkan, hapus) | ✅ | - |
| Pengaturan (profil, ganti password) | ✅ | ✅ |
| Pengaturan Aplikasi (nama usaha, alamat, kontak, default stok minimum) | ✅ | - |

### Catatan soal Export Excel
Export laporan di-generate sebagai file **CSV** (`.csv`), bukan `.xlsx` asli,
karena dependency `maatwebsite/excel` yang tadinya ada di `composer.json` versi
purba/tidak kompatibel dan sudah saya hapus (lihat bagian 0). CSV tetap terbuka
sempurna di Microsoft Excel. Kalau nanti butuh `.xlsx` asli:
```bash
composer require maatwebsite/excel
```
(gunakan versi terbaru `^3.1`, BUKAN `^1.1`), lalu ganti method `export()` di
`app/Http/Controllers/LaporanController.php` pakai `Excel::download()`.

## 3. Cara Menjalankan (Laravel Breeze + MySQL/XAMPP)

1. **Install dependency PHP**
   ```bash
   composer install
   ```

2. **Copy environment file**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Siapkan database di XAMPP** — pilih salah satu:
   - **Opsi A:** Buat database `kopikopi` di phpMyAdmin, lalu import
     `database/sql/kopikopi.sql` (lihat bagian 1)
   - **Opsi B:** Buat database `kopikopi` kosong, lalu jalankan:
     ```bash
     php artisan migrate --seed
     ```

4. **Install & build asset frontend (Tailwind via Vite)**
   ```bash
   npm install
   npm run build
   ```

5. **Jalankan server**
   ```bash
   php artisan serve
   ```
   Buka `http://localhost:8000`

**Akun yang tersedia:**
- Admin: `admin@kopikopi.com` / `Restuibu123`
- Mitra contoh: `test@example.com` / `password`

## 4. Keamanan akses data
- Mitra **hanya** bisa melihat & mengekspor/mencetak laporan **miliknya sendiri**
  (filter `user_id` di-hardcode dari user yang login, bukan dari input request).
- Route `/admin/*` diproteksi middleware `role:admin`.
- Registrasi publik selalu jadi `mitra`.

Kalau masih menemukan error setelah `composer install` + `npm run build`,
jalankan `php artisan route:list` dan `php artisan config:clear` dulu, lalu
kirim pesan error lengkapnya ke saya — jangan cuma "banyak error", supaya saya
bisa langsung tunjuk baris mana yang bermasalah.

