@extends('layouts.app')

@section('eyebrow', 'Master Data')
@section('title', 'Tambah Pelanggan')

@section('content')
    <div class="max-w-xl">
        <div class="rounded-xl bg-white border border-ink-100 shadow-paper p-6">
            <form action="{{ route('pelanggan.store') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" required class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Telepon</label>
                    <input type="text" name="telepon" class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Alamat</label>
                    <textarea name="alamat" rows="3" class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700"></textarea>
                </div>
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="rounded-lg bg-mustard-400 hover:bg-mustard-500 text-ink-800 font-semibold text-sm px-5 py-2.5 shadow-paper transition-colors">Simpan</button>
                    <a href="{{ route('pelanggan.index') }}" class="rounded-lg border border-ink-100 text-ink-500 hover:bg-paper text-sm font-medium px-5 py-2.5 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
