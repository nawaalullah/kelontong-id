@extends('layouts.app')

@section('eyebrow', 'Kasir')
@section('title', 'Edit Transaksi')

@section('content')
    <div class="max-w-2xl">
        <div class="rounded-xl bg-white border border-ink-100 shadow-paper p-6 dark:bg-slate-900 dark:border-slate-700">
            <form action="{{ route('transaksi.update', $transaksi) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-ink-700 dark:text-slate-200 mb-1.5">Produk</label>
                    <input type="text" class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100" value="{{ $transaksi->produk->nama_produk }}" disabled>
                    <p class="mt-2 text-xs text-ink-500 dark:text-slate-400">Produk tidak dapat diubah. Hapus transaksi dan buat baru jika ingin ganti produk.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-ink-700 dark:text-slate-200 mb-1.5">Jumlah</label>
                    <input type="number" name="jumlah" class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100" value="{{ old('jumlah', $transaksi->jumlah) }}" min="1" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-ink-700 dark:text-slate-200 mb-1.5">Tanggal Transaksi</label>
                    <input type="date" name="tanggal_transaksi" class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100" value="{{ old('tanggal_transaksi', \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('Y-m-d')) }}" required>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="rounded-lg bg-mustard-400 hover:bg-mustard-500 text-ink-800 font-semibold text-sm px-5 py-2.5 shadow-paper transition-colors">Perbarui</button>
                    <a href="{{ route('transaksi.index') }}" class="rounded-lg border border-ink-100 text-ink-500 hover:bg-paper text-sm font-medium px-5 py-2.5 transition-colors dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
