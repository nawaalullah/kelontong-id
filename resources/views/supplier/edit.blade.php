@extends('layouts.app')

@section('eyebrow', 'Master Data')
@section('title', 'Edit Supplier')

@section('content')
    <div class="max-w-xl">
        <div class="rounded-xl bg-white border border-ink-100 shadow-paper p-6 dark:bg-slate-900 dark:border-slate-700">
            <form action="{{ route('supplier.update', $supplier) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Nama Supplier</label>
                    <input type="text" name="nama_supplier" value="{{ old('nama_supplier', $supplier->nama_supplier) }}" required
                           class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 dark:text-slate-200 mb-1.5">Kontak (No. HP/Telepon)</label>
                    <input type="text" name="kontak" value="{{ old('kontak', $supplier->kontak) }}"
                           class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 dark:text-slate-200 mb-1.5">Alamat</label>
                    <textarea name="alamat" rows="3"
                              class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">{{ old('alamat', $supplier->alamat) }}</textarea>
                </div>
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                            class="rounded-lg bg-mustard-400 hover:bg-mustard-500 text-ink-800 font-semibold text-sm px-5 py-2.5 shadow-paper transition-colors">Perbarui</button>
                    <a href="{{ route('supplier.index') }}"
                       class="rounded-lg border border-ink-100 text-ink-500 hover:bg-paper text-sm font-medium px-5 py-2.5 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
