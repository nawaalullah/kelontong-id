<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Kategori
        $sembako = Kategori::create(['nama_kategori' => 'Sembako', 'deskripsi' => 'Kebutuhan pokok sehari-hari']);
        $minuman = Kategori::create(['nama_kategori' => 'Minuman', 'deskripsi' => 'Minuman kemasan']);

        // Supplier
        $suplierA = Supplier::create(['nama_supplier' => 'CV Sumber Makmur', 'kontak' => '0812-1111-2222', 'alamat' => 'Jl. Industri No. 1, Bandung']);
        $suplierB = Supplier::create(['nama_supplier' => 'PT Tirta Segar', 'kontak' => '0813-3333-4444', 'alamat' => 'Jl. Raya Minuman No. 5, Bandung']);

        // Produk
        $beras = Produk::create([
            'kategori_id' => $sembako->id, 'supplier_id' => $suplierA->id,
            'kode_produk' => 'SMB-001', 'nama_produk' => 'Beras 5kg', 'harga' => 65000, 'stok' => 50,
            'tanggal_kadaluarsa' => now()->addMonths(6),
        ]);
        $minyak = Produk::create([
            'kategori_id' => $sembako->id, 'supplier_id' => $suplierA->id,
            'kode_produk' => 'SMB-002', 'nama_produk' => 'Minyak Goreng 1L', 'harga' => 18000, 'stok' => 40,
            'tanggal_kadaluarsa' => now()->addDays(12),
        ]);
        $teh = Produk::create([
            'kategori_id' => $minuman->id, 'supplier_id' => $suplierB->id,
            'kode_produk' => 'MNM-001', 'nama_produk' => 'Teh Botol 350ml', 'harga' => 5000, 'stok' => 100,
            'tanggal_kadaluarsa' => now()->subDays(3),
        ]);
        $air = Produk::create([
            'kategori_id' => $minuman->id, 'supplier_id' => $suplierB->id,
            'kode_produk' => 'MNM-002', 'nama_produk' => 'Air Mineral 600ml', 'harga' => 4000, 'stok' => 3,
            'tanggal_kadaluarsa' => now()->addYear(),
        ]);

        // Transaksi contoh #1: multi-item (2 produk dalam 1 nota)
        $transaksi1 = Transaksi::create([
            'no_transaksi'      => 'TRX-' . strtoupper(Str::random(8)),
            'tanggal_transaksi' => now(),
            'nama_pelanggan'    => 'Budi',
            'total_keseluruhan' => ($beras->harga * 2) + ($teh->harga * 3),
            'metode_pembayaran' => 'qris',
        ]);
        TransaksiDetail::create(['transaksi_id' => $transaksi1->id, 'produk_id' => $beras->id, 'jumlah' => 2, 'harga_satuan' => $beras->harga, 'subtotal' => $beras->harga * 2]);
        TransaksiDetail::create(['transaksi_id' => $transaksi1->id, 'produk_id' => $teh->id, 'jumlah' => 3, 'harga_satuan' => $teh->harga, 'subtotal' => $teh->harga * 3]);
        $beras->decrement('stok', 2);
        $teh->decrement('stok', 3);

        // Transaksi contoh #2: 1 item
        $transaksi2 = Transaksi::create([
            'no_transaksi'      => 'TRX-' . strtoupper(Str::random(8)),
            'tanggal_transaksi' => now()->subDay(),
            'nama_pelanggan'    => 'Siti',
            'total_keseluruhan' => $minyak->harga * 1,
            'metode_pembayaran' => 'cash',
        ]);
        TransaksiDetail::create(['transaksi_id' => $transaksi2->id, 'produk_id' => $minyak->id, 'jumlah' => 1, 'harga_satuan' => $minyak->harga, 'subtotal' => $minyak->harga]);
        $minyak->decrement('stok', 1);
    }
}
