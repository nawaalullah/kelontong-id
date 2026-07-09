@extends('layouts.app')

@section('eyebrow', 'Master Data')
@section('title', 'Kategori')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <p class="text-ink-500 text-sm">Kelompokkan produk agar rak lebih mudah diurus.</p>
        <a href="{{ route('kategori.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-mustard-400 hover:bg-mustard-500 text-ink-800 font-semibold text-sm px-4 py-2.5 shadow-paper transition-colors">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            Tambah Kategori
        </a>
    </div>

    <div class="rounded-xl bg-white border border-ink-100 shadow-paper overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs uppercase tracking-wider text-ink-400 bg-paper">
                        <th class="px-5 py-3 font-semibold">#</th>
                        <th class="px-5 py-3 font-semibold">Nama Kategori</th>
                        <th class="px-5 py-3 font-semibold">Deskripsi</th>
                        <th class="px-5 py-3 font-semibold">Jumlah Produk</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100">
                    @forelse ($kategoris as $kategori)
                        <tr class="hover:bg-paper/60">
                            <td class="px-5 py-3 text-ink-400">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 font-medium text-ink-700">{{ $kategori->nama_kategori }}</td>
                            <td class="px-5 py-3 text-ink-500">{{ $kategori->deskripsi ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center rounded-full bg-leaf-50 text-leaf-600 text-xs font-semibold px-2.5 py-1">{{ $kategori->produk_count }} produk</span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('kategori.edit', $kategori) }}"
                                       class="rounded-md border border-mustard-300 text-mustard-700 hover:bg-mustard-50 text-xs font-semibold px-3 py-1.5 transition-colors">Edit</a>
                                    <form action="{{ route('kategori.destroy', $kategori) }}" method="POST"
                                          onsubmit="return confirm('Hapus kategori ini? Produk & transaksi terkait juga akan terhapus.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="rounded-md border border-clay-300 text-clay-600 hover:bg-clay-50 text-xs font-semibold px-3 py-1.5 transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-ink-400">Belum ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($kategoris->hasPages())
            <div class="px-5 py-4 border-t border-ink-100">
                {{ $kategoris->links() }}
            </div>
        @endif
    </div>
@endsection
