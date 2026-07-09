# Kelontong.id — Sistem Manajemen Toko Kelontong (Laravel + MySQL)

Versi lengkap dengan 5 tabel berelasi, transaksi kasir multi-item (seperti struk belanja), dan dashboard laporan bergrafik.

## Struktur Relasi Database

```
Kategori (1) ──< Produk >── (1) Supplier
                   │
                   └──< TransaksiDetail >── (1) Transaksi
```

- **Kategori** punya banyak **Produk**
- **Supplier** memasok banyak **Produk** (opsional, boleh kosong)
- **Produk** muncul di banyak **TransaksiDetail** (baris item nota)
- **Transaksi** (nota/header) punya banyak **TransaksiDetail** — inilah yang membuat 1 transaksi bisa berisi banyak produk sekaligus, seperti struk kasir sungguhan

## Fitur

### CRUD dasar
- Kategori — tambah/edit/hapus
- Supplier — tambah/edit/hapus
- Produk — tambah/edit/hapus (pilih kategori & supplier)

### Kasir (Transaksi multi-item)
- Halaman "Transaksi Baru" punya form dinamis: tambah/hapus baris item dengan JavaScript
- Subtotal per baris & total keseluruhan dihitung otomatis secara real-time di browser
- Saat disimpan: nomor nota otomatis (`TRX-XXXXXXXX`), stok setiap produk yang terjual otomatis berkurang, validasi stok tidak boleh minus
- Ada halaman "Lihat Struk" untuk detail nota
- Hapus transaksi akan mengembalikan stok semua item di nota tersebut

### Dashboard & Laporan
- Kartu ringkasan: total produk, total transaksi, total pendapatan, jumlah produk stok menipis
- Grafik garis: tren penjualan 7 hari terakhir (Chart.js)
- Grafik batang: 5 produk terlaris
- Tabel produk dengan stok menipis (≤5)

## Struktur file

```
warungku/
├── app/
│   ├── Models/
│   │   ├── Kategori.php
│   │   ├── Supplier.php
│   │   ├── Produk.php
│   │   ├── Transaksi.php
│   │   └── TransaksiDetail.php
│   └── Http/Controllers/
│       ├── DashboardController.php
│       ├── KategoriController.php
│       ├── SupplierController.php
│       ├── ProdukController.php
│       └── TransaksiController.php
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_1_create_suppliers_table.php
│   │   ├── 2024_01_01_000001_create_kategoris_table.php
│   │   ├── 2024_01_01_000002_create_produks_table.php
│   │   ├── 2024_01_01_000003_create_transaksis_table.php
│   │   └── 2024_01_01_000004_create_transaksi_details_table.php
│   └── seeders/DatabaseSeeder.php
├── routes/web.php
└── resources/views/
    ├── layouts/app.blade.php
    ├── dashboard/index.blade.php
    ├── kategori/{index,create,edit}.blade.php
    ├── supplier/{index,create,edit}.blade.php
    ├── produk/{index,create,edit}.blade.php
    └── transaksi/{index,create,show}.blade.php   (tanpa edit — nota bersifat final)
```

## Cara instalasi

### 1. Buat project Laravel baru
```bash
composer create-project laravel/laravel warungku
cd warungku
```

### 2. Salin/timpa file dari paket ini
Copy seluruh isi folder `app`, `database`, `routes`, `resources` dari paket ini ke project barumu (timpa file yang sudah ada seperti `routes/web.php` dan `database/seeders/DatabaseSeeder.php`).

### 3. Konfigurasi `.env`
Laravel 11 defaultnya pakai SQLite — ganti ke MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kelontong_id
DB_USERNAME=root
DB_PASSWORD=
```
Setelah edit `.env`, jalankan:
```bash
php artisan config:clear
```

### 4. Buat database
```sql
CREATE DATABASE kelontong_id;
```

### 5. Migrasi & seed data contoh
Kalau sebelumnya sudah pernah migrate dengan struktur lama (3 tabel), **wajib pakai `migrate:fresh`** supaya tabel lama (termasuk kolom `produk_id` di `transaksis`) dibuang dan dibuat ulang sesuai struktur baru:
```bash
php artisan migrate:fresh --seed
```

### 6. Jalankan server
```bash
php artisan serve
```
Buka `http://127.0.0.1:8000` — akan diarahkan ke **Dashboard**.

## Catatan penting

- **Transaksi tidak punya fitur Edit.** Ini disengaja — nota kasir umumnya bersifat final setelah dicetak/disimpan. Kalau salah input, hapus nota (stok otomatis dikembalikan) lalu buat transaksi baru.
- Field `supplier_id` di tabel `produks` bersifat **nullable** — produk boleh tidak punya supplier.
- Grafik dashboard pakai **Chart.js** via CDN, tidak perlu install package tambahan.
- Kalau mau kembangkan lebih lanjut: tambah tabel `pembelian` (stok masuk dari supplier), sistem login/role (admin vs kasir), atau cetak struk ke PDF.
