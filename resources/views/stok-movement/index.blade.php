@extends('layouts.app')

@section('eyebrow', 'Stok')
@section('title', 'Riwayat Stok')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <p class="text-ink-500 text-sm">Catatan barang masuk dan keluar agar stok selalu terkontrol.</p>
        <a href="{{ route('stok-movement.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-mustard-400 hover:bg-mustard-500 text-ink-800 font-semibold text-sm px-4 py-2.5 shadow-paper transition-colors">Tambah Riwayat</a>
    </div>

    <form action="{{ route('stok-movement.index') }}" method="GET" class="flex items-center gap-3 mb-4">
        <div class="relative flex-1 max-w-xs">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari produk..." class="w-full rounded-lg border border-ink-100 bg-white px-3 py-2 text-sm text-ink-700">
        </div>
        <button type="submit" class="rounded-lg bg-ink-700 hover:bg-ink-800 text-white text-sm font-semibold px-4 py-2 transition-colors">Cari</button>
    </form>

    <div class="rounded-xl bg-white border border-ink-100 shadow-paper overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs uppercase tracking-wider text-ink-400 bg-paper">
                        <th class="px-5 py-3 font-semibold">#</th>
                        <th class="px-5 py-3 font-semibold">Produk</th>
                        <th class="px-5 py-3 font-semibold">Jenis</th>
                        <th class="px-5 py-3 font-semibold">Jumlah</th>
                        <th class="px-5 py-3 font-semibold">Keterangan</th>
                        <th class="px-5 py-3 font-semibold">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100">
                    @forelse ($movements as $movement)
                        <tr class="hover:bg-paper/60">
                            <td class="px-5 py-3 text-ink-400">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 font-medium text-ink-700">{{ $movement->produk->nama_produk }}</td>
                            <td class="px-5 py-3">
                                @if ($movement->jenis === 'masuk')
                                    <span class="inline-flex items-center rounded-full bg-leaf-50 text-leaf-600 text-xs font-semibold px-2.5 py-1">Masuk</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-clay-50 text-clay-600 text-xs font-semibold px-2.5 py-1">Keluar</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 font-mono text-ink-700">{{ $movement->jumlah }}</td>
                            <td class="px-5 py-3 text-ink-500">{{ $movement->keterangan ?? '-' }}</td>
                            <td class="px-5 py-3 text-ink-500">{{ $movement->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-10 text-center text-ink-400">Belum ada riwayat stok.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($movements->hasPages())
            <div class="px-5 py-4 border-t border-ink-100">{{ $movements->links() }}</div>
        @endif
    </div>
@endsection
