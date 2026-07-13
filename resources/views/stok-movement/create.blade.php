@extends('layouts.app')

@section('eyebrow', 'Stok')
@section('title', 'Tambah Riwayat Stok')

@section('content')
    <div class="max-w-xl">
        <div class="rounded-xl bg-white border border-ink-100 shadow-paper p-6">
            <form action="{{ route('stok-movement.store') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Produk</label>
                    <select name="produk_id" required class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700">
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($produks as $produk)
                            <option value="{{ $produk->id }}">{{ $produk->nama_produk }} (Stok: {{ $produk->stok }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Jenis</label>
                    <select name="jenis" required class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700">
                        <option value="masuk">Masuk</option>
                        <option value="keluar">Keluar</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Jumlah</label>
                    <input type="number" name="jumlah" min="1" required class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Keterangan</label>
                    <input type="text" name="keterangan" class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700">
                </div>
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="rounded-lg bg-mustard-400 hover:bg-mustard-500 text-ink-800 font-semibold text-sm px-5 py-2.5 shadow-paper transition-colors">Simpan</button>
                    <a href="{{ route('stok-movement.index') }}" class="rounded-lg border border-ink-100 text-ink-500 hover:bg-paper text-sm font-medium px-5 py-2.5 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
