<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $transaksis = Transaksi::withCount('detail')
            ->when($search, fn ($query) => $query->where('nama_pelanggan', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->appends($request->query());

        return view('transaksi.index', compact('transaksis', 'search'));
    }

    public function create(): View
    {
        $produks = Produk::where('stok', '>', 0)->orderBy('nama_produk')->get();

        $produkList = $produks->map(function ($p) {
            return [
                'id'    => $p->id,
                'nama'  => $p->nama_produk,
                'harga' => $p->harga,
                'stok'  => $p->stok,
            ];
        });

        return view('transaksi.create', compact('produks', 'produkList'));
    }

    /**
     * Simpan transaksi + banyak baris item (keranjang) sekaligus.
     * Request diharapkan mengirim:
     *   nama_pelanggan
     *   tanggal_transaksi
     *   produk_id[]  -> array id produk per baris
     *   jumlah[]     -> array jumlah per baris (index sejajar dengan produk_id[])
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_pelanggan'      => 'nullable|string|max:255',
            'tanggal_transaksi'   => 'required|date',
            'metode_pembayaran'   => 'required|in:cash,qris',
            'produk_id'           => 'required|array|min:1',
            'produk_id.*'         => 'required|exists:produks,id',
            'jumlah'              => 'required|array|min:1',
            'jumlah.*'            => 'required|integer|min:1',
        ]);

        // Cek stok untuk setiap baris sebelum menyimpan apa pun
        $items = [];
        foreach ($validated['produk_id'] as $i => $produkId) {
            $produk = Produk::findOrFail($produkId);
            $jumlah = $validated['jumlah'][$i];

            if ($jumlah > $produk->stok) {
                return back()->withInput()
                    ->withErrors(['jumlah' => "Stok {$produk->nama_produk} tidak mencukupi. Sisa stok: {$produk->stok}"]);
            }

            $items[] = ['produk' => $produk, 'jumlah' => $jumlah];
        }

        DB::transaction(function () use ($items, $validated) {
            $total = 0;
            foreach ($items as $item) {
                $total += $item['produk']->harga * $item['jumlah'];
            }

            $transaksi = Transaksi::create([
                'no_transaksi'       => 'TRX-' . strtoupper(Str::random(8)),
                'tanggal_transaksi'  => $validated['tanggal_transaksi'],
                'nama_pelanggan'     => $validated['nama_pelanggan'] ?? null,
                'total_keseluruhan'  => $total,
                'metode_pembayaran'  => $validated['metode_pembayaran'],
            ]);

            foreach ($items as $item) {
                TransaksiDetail::create([
                    'transaksi_id'  => $transaksi->id,
                    'produk_id'     => $item['produk']->id,
                    'jumlah'        => $item['jumlah'],
                    'harga_satuan'  => $item['produk']->harga,
                    'subtotal'      => $item['produk']->harga * $item['jumlah'],
                ]);

                $item['produk']->decrement('stok', $item['jumlah']);
            }
        });

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dicatat.');
    }

    public function show(Transaksi $transaksi): View
    {
        $transaksi->load('detail.produk');
        return view('transaksi.show', compact('transaksi'));
    }

    public function destroy(Transaksi $transaksi): RedirectResponse
    {
        DB::transaction(function () use ($transaksi) {
            // Kembalikan stok semua item sebelum nota dihapus
            foreach ($transaksi->detail as $item) {
                $item->produk?->increment('stok', $item->jumlah);
            }
            $transaksi->delete(); // detail ikut terhapus (cascade)
        });

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus, stok telah dikembalikan.');
    }
}
