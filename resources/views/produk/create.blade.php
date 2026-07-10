@extends('layouts.app')

@section('eyebrow', 'Master Data')
@section('title', 'Tambah Produk')

@section('content')
    <div class="max-w-2xl">
        <div class="rounded-xl bg-white border border-ink-100 shadow-paper p-6 dark:bg-slate-900 dark:border-slate-700">
            <form action="{{ route('produk.store') }}" method="POST" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-ink-700 mb-1.5">Kategori</label>
                        <select name="kategori_id" required
                                class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-ink-700 mb-1.5">Supplier (opsional)</label>
                        <select name="supplier_id"
                                class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">-- Tanpa Supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->nama_supplier }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Kode Produk</label>
                    <input type="text" name="kode_produk" value="{{ old('kode_produk') }}" required
                           class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm font-mono text-ink-700 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Nama Produk</label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" required
                           class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-ink-700 mb-1.5">Harga (Rp)</label>
                        <input type="number" name="harga" value="{{ old('harga') }}" min="0" required
                               class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-ink-700 mb-1.5">Stok</label>
                        <input type="number" name="stok" value="{{ old('stok') }}" min="0" required
                               class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Tanggal Kadaluarsa (opsional)</label>
                    <input type="date" name="tanggal_kadaluarsa" value="{{ old('tanggal_kadaluarsa') }}"
                           class="w-full sm:w-1/2 rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                    <p class="text-xs text-ink-400 mt-1">Kosongkan jika produk ini tidak punya masa kadaluarsa.</p>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                            class="rounded-lg bg-mustard-400 hover:bg-mustard-500 text-ink-800 font-semibold text-sm px-5 py-2.5 shadow-paper transition-colors">Simpan</button>
                    <a href="{{ route('produk.index') }}"
                       class="rounded-lg border border-ink-100 text-ink-500 hover:bg-paper text-sm font-medium px-5 py-2.5 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
