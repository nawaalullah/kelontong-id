@extends('layouts.app')

@section('eyebrow', 'Master Data')
@section('title', 'Tambah Stok')

@section('content')
    <div class="max-w-xl">
        <div class="rounded-xl bg-white border border-ink-100 shadow-paper p-6 dark:bg-slate-900 dark:border-slate-700">
            <p class="text-sm text-ink-500 mb-4">Tambah stok untuk <span class="font-semibold text-ink-700">{{ $produk->nama_produk }}</span> saat ada barang masuk dari supplier.</p>

            <form action="{{ route('produk.tambah-stok.store', $produk) }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Jumlah Stok Ditambah</label>
                    <input type="number" name="jumlah" min="1" required
                           class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
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
