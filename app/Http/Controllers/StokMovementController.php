<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\StokMovement;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class StokMovementController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $movements = StokMovement::with('produk')
            ->when($search, fn ($query) => $query->whereHas('produk', fn ($q) => $q->where('nama_produk', 'like', "%{$search}%")))
            ->latest()
            ->paginate(10)
            ->appends($request->query());

        return view('stok-movement.index', compact('movements', 'search'));
    }

    public function create(): View
    {
        $produks = Produk::orderBy('nama_produk')->get();
        return view('stok-movement.create', compact('produks'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $produk = Produk::findOrFail($validated['produk_id']);

        DB::transaction(function () use ($produk, $validated) {
            if ($validated['jenis'] === 'keluar' && $produk->stok < $validated['jumlah']) {
                throw new \Exception('Stok tidak mencukupi untuk pengeluaran.');
            }

            StokMovement::create($validated);

            if ($validated['jenis'] === 'masuk') {
                $produk->increment('stok', $validated['jumlah']);
            } else {
                $produk->decrement('stok', $validated['jumlah']);
            }
        });

        return redirect()->route('stok-movement.index')->with('success', 'Riwayat stok berhasil disimpan.');
    }
}
