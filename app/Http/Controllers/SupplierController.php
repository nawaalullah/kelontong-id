<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SupplierController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $suppliers = Supplier::withCount('produk')
            ->when($search, fn ($query) => $query->where('nama_supplier', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->appends($request->query());

        return view('supplier.index', compact('suppliers', 'search'));
    }

    public function create(): View
    {
        return view('supplier.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'kontak'        => 'nullable|string|max:50',
            'alamat'        => 'nullable|string',
        ]);

        Supplier::create($validated);

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier): View
    {
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier): RedirectResponse
    {
        $validated = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'kontak'        => 'nullable|string|max:50',
            'alamat'        => 'nullable|string',
        ]);

        $supplier->update($validated);

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier): RedirectResponse
    {
        $supplier->delete();

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}
