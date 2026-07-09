@extends('layouts.app')

@section('eyebrow', 'Master Data')
@section('title', 'Produk')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <p class="text-ink-500 text-sm">Semua barang yang dijual di warung, lengkap dengan stoknya.</p>
        <a href="{{ route('produk.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-mustard-400 hover:bg-mustard-500 text-ink-800 font-semibold text-sm px-4 py-2.5 shadow-paper transition-colors">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            Tambah Produk
        </a>
    </div>

    <div class="rounded-xl bg-white border border-ink-100 shadow-paper overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs uppercase tracking-wider text-ink-400 bg-paper">
                        <th class="px-5 py-3 font-semibold">#</th>
                        <th class="px-5 py-3 font-semibold">Kode</th>
                        <th class="px-5 py-3 font-semibold">Nama Produk</th>
                        <th class="px-5 py-3 font-semibold">Kategori</th>
                        <th class="px-5 py-3 font-semibold">Supplier</th>
                        <th class="px-5 py-3 font-semibold">Harga</th>
                        <th class="px-5 py-3 font-semibold">Stok</th>
                        <th class="px-5 py-3 font-semibold">Kadaluarsa</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100">
                    @forelse ($produks as $produk)
                        <tr class="hover:bg-paper/60">
                            <td class="px-5 py-3 text-ink-400">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 font-mono text-xs text-ink-500">{{ $produk->kode_produk }}</td>
                            <td class="px-5 py-3 font-medium text-ink-700">{{ $produk->nama_produk }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center rounded-full bg-ink-50 text-ink-500 text-xs font-semibold px-2.5 py-1">{{ $produk->kategori->nama_kategori }}</span>
                            </td>
                            <td class="px-5 py-3 text-ink-500">{{ $produk->supplier->nama_supplier ?? '-' }}</td>
                            <td class="px-5 py-3 font-mono text-ink-700">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td class="px-5 py-3">
                                @if ($produk->stok <= 5)
                                    <span class="inline-flex items-center rounded-full bg-clay-50 text-clay-600 text-xs font-semibold px-2.5 py-1">{{ $produk->stok }}</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-leaf-50 text-leaf-600 text-xs font-semibold px-2.5 py-1">{{ $produk->stok }}</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                @if (! $produk->tanggal_kadaluarsa)
                                    <span class="text-ink-300 text-xs">-</span>
                                @elseif ($produk->status_kadaluarsa === 'expired')
                                    <span class="inline-flex items-center rounded-full bg-clay-50 text-clay-600 text-xs font-semibold px-2.5 py-1">
                                        Kadaluarsa {{ $produk->tanggal_kadaluarsa->format('d-m-Y') }}
                                    </span>
                                @elseif ($produk->status_kadaluarsa === 'segera')
                                    <span class="inline-flex items-center rounded-full bg-mustard-100 text-mustard-700 text-xs font-semibold px-2.5 py-1">
                                        {{ $produk->tanggal_kadaluarsa->format('d-m-Y') }} ({{ $produk->sisa_kadaluarsa_text }})
                                    </span>
                                @else
                                    <span class="text-ink-500 text-xs">{{ $produk->tanggal_kadaluarsa->format('d-m-Y') }}</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('produk.edit', $produk) }}"
                                       class="rounded-md border border-mustard-300 text-mustard-700 hover:bg-mustard-50 text-xs font-semibold px-3 py-1.5 transition-colors">Edit</a>
                                    <form action="{{ route('produk.destroy', $produk) }}" method="POST"
                                          onsubmit="return confirm('Hapus produk ini?')">
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
                            <td colspan="9" class="px-5 py-10 text-center text-ink-400">Belum ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($produks->hasPages())
            <div class="px-5 py-4 border-t border-ink-100">
                {{ $produks->links() }}
            </div>
        @endif
    </div>
@endsection
