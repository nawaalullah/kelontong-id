<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProdukController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $produks = Produk::with(['kategori', 'supplier'])
            ->when($search, fn ($query) => $query->where('nama_produk', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->appends($request->query());

        return view('produk.index', compact('produks', 'search'));
    }

    public function create(): View
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $suppliers = Supplier::orderBy('nama_supplier')->get();
        return view('produk.create', compact('kategoris', 'suppliers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_id'  => 'required|exists:kategoris,id',
            'supplier_id'  => 'nullable|exists:suppliers,id',
            'kode_produk'  => 'required|string|max:50|unique:produks,kode_produk',
            'nama_produk'  => 'required|string|max:255',
            'harga'        => 'required|integer|min:0',
            'stok'         => 'required|integer|min:0',
            'tanggal_kadaluarsa' => 'nullable|date',
        ]);

        Produk::create($validated);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk): View
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $suppliers = Supplier::orderBy('nama_supplier')->get();
        return view('produk.edit', compact('produk', 'kategoris', 'suppliers'));
    }

    public function update(Request $request, Produk $produk): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_id'  => 'required|exists:kategoris,id',
            'supplier_id'  => 'nullable|exists:suppliers,id',
            'kode_produk'  => 'required|string|max:50|unique:produks,kode_produk,' . $produk->id,
            'nama_produk'  => 'required|string|max:255',
            'harga'        => 'required|integer|min:0',
            'stok'         => 'required|integer|min:0',
            'tanggal_kadaluarsa' => 'nullable|date',
        ]);

        $produk->update($validated);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk): RedirectResponse
    {
        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
