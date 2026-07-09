<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Ringkasan kartu atas
        $totalProduk       = Produk::count();
        $totalTransaksi    = Transaksi::count();
        $totalPendapatan   = Transaksi::sum('total_keseluruhan');
        $produkStokMenipis = Produk::where('stok', '<=', 5)->where('stok', '>', 0)->count();
        $produkStokHabis   = Produk::where('stok', '<=', 0)->count();
        $produkAkanKadaluarsa = Produk::akanKadaluarsa()->count();
        $produkSudahKadaluarsa = Produk::sudahKadaluarsa()->count();

        // Ringkasan pembayaran hari ini (cash vs qris)
        $hariIni = now()->toDateString();
        $totalTransaksiHariIni = Transaksi::where('tanggal_transaksi', $hariIni)->count();
        $totalPenjualanHariIni = Transaksi::where('tanggal_transaksi', $hariIni)->sum('total_keseluruhan');
        $totalCashHariIni      = Transaksi::where('tanggal_transaksi', $hariIni)->where('metode_pembayaran', 'cash')->sum('total_keseluruhan');
        $totalQrisHariIni      = Transaksi::where('tanggal_transaksi', $hariIni)->where('metode_pembayaran', 'qris')->sum('total_keseluruhan');

        // Grafik 1: total penjualan 7 hari terakhir, dipecah per metode pembayaran (cash / qris)
        $penjualanHarian = Transaksi::selectRaw('tanggal_transaksi, metode_pembayaran, SUM(total_keseluruhan) as total')
            ->where('tanggal_transaksi', '>=', now()->subDays(6)->toDateString())
            ->groupBy('tanggal_transaksi', 'metode_pembayaran')
            ->orderBy('tanggal_transaksi')
            ->get();

        $rentangTanggal = collect(range(0, 6))
            ->map(fn ($i) => now()->subDays(6 - $i)->toDateString());

        $labelPenjualan = $rentangTanggal->map(fn ($t) => \Carbon\Carbon::parse($t)->format('d/m'));

        $dataPenjualan = $rentangTanggal->map(function ($tanggal) use ($penjualanHarian) {
            return $penjualanHarian->where('tanggal_transaksi', $tanggal)->sum('total');
        });

        $dataCash = $rentangTanggal->map(function ($tanggal) use ($penjualanHarian) {
            return $penjualanHarian->where('tanggal_transaksi', $tanggal)->where('metode_pembayaran', 'cash')->sum('total');
        });

        $dataQris = $rentangTanggal->map(function ($tanggal) use ($penjualanHarian) {
            return $penjualanHarian->where('tanggal_transaksi', $tanggal)->where('metode_pembayaran', 'qris')->sum('total');
        });

        // Grafik 2: 5 produk terlaris (berdasarkan jumlah terjual)
        $produkTerlaris = TransaksiDetail::select('produk_id', DB::raw('SUM(jumlah) as total_terjual'))
            ->with('produk:id,nama_produk')
            ->groupBy('produk_id')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        $labelTerlaris = $produkTerlaris->map(fn ($d) => $d->produk->nama_produk ?? '—');
        $dataTerlaris  = $produkTerlaris->pluck('total_terjual');

        // Tabel: produk terdaftar (terbaru ditambahkan)
        $produkTerdaftar = Produk::with('kategori')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // Tabel: produk dengan stok menipis (belum habis)
        $stokMenipis = Produk::with('kategori')->where('stok', '<=', 5)->where('stok', '>', 0)->orderBy('stok')->limit(10)->get();

        // Tabel: produk dengan stok habis
        $stokHabis = Produk::with('kategori')->where('stok', '<=', 0)->orderBy('nama_produk')->limit(10)->get();

        // Tabel: produk yang sudah/akan kadaluarsa (gabung, sudah expired ditampilkan lebih dulu)
        $produkKadaluarsa = Produk::with('kategori')
            ->whereNotNull('tanggal_kadaluarsa')
            ->whereDate('tanggal_kadaluarsa', '<=', now()->addDays(Produk::BATAS_HARI_AKAN_KADALUARSA)->toDateString())
            ->orderBy('tanggal_kadaluarsa')
            ->limit(10)
            ->get();

        return view('dashboard.index', compact(
            'totalProduk',
            'totalTransaksi',
            'totalPendapatan',
            'produkStokMenipis',
            'produkStokHabis',
            'produkAkanKadaluarsa',
            'produkSudahKadaluarsa',
            'totalTransaksiHariIni',
            'totalPenjualanHariIni',
            'totalCashHariIni',
            'totalQrisHariIni',
            'labelPenjualan',
            'dataPenjualan',
            'dataCash',
            'dataQris',
            'labelTerlaris',
            'dataTerlaris',
            'produkTerdaftar',
            'stokMenipis',
            'stokHabis',
            'produkKadaluarsa'
        ));
    }
}