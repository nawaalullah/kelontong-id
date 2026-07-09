# 🛒 Kelontong.id

**Kelontong.id** adalah aplikasi **Sistem Manajemen Toko Kelontong** berbasis **Laravel 11** dan **MySQL** yang dirancang untuk membantu pengelolaan data produk, kategori, supplier, transaksi kasir multi-item, serta laporan penjualan dalam satu dashboard yang sederhana dan mudah digunakan.

---

## ✨ Fitur Utama

### 📦 Manajemen Data
- CRUD Kategori
- CRUD Supplier
- CRUD Produk
- Relasi Produk dengan Kategori
- Relasi Produk dengan Supplier

### 💳 Sistem Kasir
- Transaksi multi-item (seperti struk minimarket)
- Tambah dan hapus item transaksi secara dinamis
- Perhitungan subtotal dan total otomatis
- Nomor transaksi otomatis (`TRX-XXXXXXXX`)
- Validasi stok agar tidak bernilai negatif
- Pengurangan stok otomatis setelah transaksi
- Detail transaksi (struk)
- Hapus transaksi akan mengembalikan stok

### 📊 Dashboard
- Total Produk
- Total Transaksi
- Total Pendapatan
- Produk dengan stok menipis
- Grafik penjualan 7 hari terakhir
- Grafik 5 produk terlaris
- Tabel stok menipis

---

# 🗄️ Struktur Relasi Database

```
Kategori (1)
      │
      ▼
   Produk
      ▲
      │
Supplier (1)

Produk (1)
      │
      ▼
TransaksiDetail
      ▲
      │
Transaksi (1)
```

Relasi:

- Satu kategori memiliki banyak produk.
- Satu supplier dapat memasok banyak produk.
- Satu transaksi memiliki banyak detail transaksi.
- Satu produk dapat muncul pada banyak transaksi.

---

# 🛠️ Teknologi

- Laravel 11
- PHP 8.2+
- MySQL
- Blade Template Engine
- Bootstrap 5
- JavaScript
- Chart.js

---

# 📁 Struktur Project

```
warungku/
├── app/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── .env
└── README.md
```

---

# 🚀 Instalasi

## 1. Clone Repository

```bash
git clone https://github.com/username/kelontong-id.git
```

Masuk ke folder project

```bash
cd kelontong-id
```

---

## 2. Install Dependency

```bash
composer install
```

---

## 3. Copy File Environment

Linux / macOS

```bash
cp .env.example .env
```

Windows

```bash
copy .env.example .env
```

---

## 4. Generate Application Key

```bash
php artisan key:generate
```

---

## 5. Konfigurasi Database

Edit file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kelontong_id
DB_USERNAME=root
DB_PASSWORD=
```

Kemudian bersihkan cache konfigurasi

```bash
php artisan config:clear
```

---

## 6. Buat Database

```sql
CREATE DATABASE kelontong_id;
```

---

## 7. Jalankan Migration

Instalasi pertama

```bash
php artisan migrate --seed
```

Jika sebelumnya pernah menggunakan struktur lama

```bash
php artisan migrate:fresh --seed
```

---

## 8. Jalankan Aplikasi

```bash
php artisan serve
```

Buka browser

```
http://127.0.0.1:8000
```

---

# 📖 Cara Penggunaan

## 1. Tambahkan Kategori

Menu **Kategori** → **Tambah Kategori**

Contoh:

- Makanan
- Minuman
- Sembako

---

## 2. Tambahkan Supplier

Menu **Supplier** → **Tambah Supplier**

Isi informasi supplier.

Supplier bersifat opsional.

---

## 3. Tambahkan Produk

Menu **Produk** → **Tambah Produk**

Isi data:

- Nama Produk
- Harga
- Stok
- Kategori
- Supplier (Opsional)

Klik **Simpan**.

---

## 4. Membuat Transaksi

Menu **Transaksi** → **Transaksi Baru**

Langkah:

1. Pilih produk.
2. Tentukan jumlah pembelian.
3. Tambahkan item lain jika diperlukan.
4. Total akan dihitung otomatis.
5. Klik **Simpan**.

Setelah transaksi berhasil:

- Nomor nota dibuat otomatis.
- Stok produk berkurang otomatis.
- Detail transaksi tersimpan.

---

## 5. Melihat Struk

Menu **Transaksi**

Klik tombol **Lihat**.

Informasi yang ditampilkan:

- Nomor Nota
- Tanggal
- Daftar Produk
- Harga
- Jumlah
- Subtotal
- Total Pembayaran

---

## 6. Menghapus Transaksi

Saat transaksi dihapus:

- Seluruh stok produk dikembalikan.
- Detail transaksi ikut terhapus.
- Data transaksi dihapus.

---

# 📊 Dashboard

Dashboard menyediakan informasi:

- Total Produk
- Total Pendapatan
- Total Transaksi
- Produk stok menipis
- Grafik penjualan 7 hari
- Grafik produk terlaris

---

# 📌 Catatan

- Produk tidak dapat dijual melebihi stok.
- Supplier bersifat opsional.
- Transaksi tidak dapat diedit.
- Jika terjadi kesalahan input, hapus transaksi kemudian buat transaksi baru.
- Dashboard menggunakan Chart.js melalui CDN.

---

# 🔮 Pengembangan Selanjutnya

Beberapa fitur yang dapat dikembangkan:

- Login Multi Role
- Barcode Scanner
- Cetak Struk PDF
- Export Excel
- Import Produk
- Pembelian Barang
- Retur Barang
- Laporan Bulanan
- Manajemen Pelanggan

---

# 👨‍💻 Developer

Project ini dikembangkan oleh:

- **Ikhlas Nawaalullah**
- **Aqil Arsalan Rukmandani**
- **Febry Febriansyah**
- **Andi Adi Saputra**

---

# 🤝 Contributors

Kami terbuka terhadap kontribusi.

Langkah kontribusi:

1. Fork repository
2. Buat branch baru

```bash
git checkout -b fitur-baru
```

3. Commit perubahan

```bash
git commit -m "Menambahkan fitur baru"
```

4. Push

```bash
git push origin fitur-baru
```

5. Buat Pull Request

---

# 📄 License

Project ini menggunakan lisensi **MIT License**.

Lihat file **LICENSE** untuk informasi selengkapnya.

---

<div align="center">

# Kelontong.id

**Sistem Manajemen Toko Kelontong Berbasis Laravel 11 & MySQL**

© 2026

**Project Team**

Ikhlas Nawaalullah | Aqil Arsalan Rukmandani | Febry Febriansyah | Andi Adi Saputra

</div>
