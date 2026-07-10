@extends('layouts.app')

@section('eyebrow', 'Master Data')
@section('title', 'Supplier')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <p class="text-ink-500 text-sm">Daftar pemasok barang yang mengisi rak warung.</p>
        <a href="{{ route('supplier.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-mustard-400 hover:bg-mustard-500 text-ink-800 font-semibold text-sm px-4 py-2.5 shadow-paper transition-colors">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            Tambah Supplier
        </a>
    </div>

    <form action="{{ route('supplier.index') }}" method="GET" class="flex items-center gap-3 mb-4">
        <div class="relative flex-1 max-w-xs">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" class="absolute left-3 top-1/2 -translate-y-1/2 text-ink-300"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.35-4.35"/></svg>
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama supplier..."
                   class="w-full rounded-lg border border-ink-100 bg-white pl-9 pr-3 py-2 text-sm text-ink-700 placeholder:text-ink-300 focus:outline-none focus:ring-2 focus:ring-mustard-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-400">
        </div>
        <button type="submit"
                class="rounded-lg bg-ink-700 hover:bg-ink-800 text-white text-sm font-semibold px-4 py-2 transition-colors">Cari</button>
        @if ($search)
            <a href="{{ route('supplier.index') }}" class="text-xs text-ink-400 hover:text-clay-600 underline">Reset</a>
        @endif
    </form>

    <div class="rounded-xl bg-white border border-ink-100 shadow-paper overflow-hidden dark:bg-slate-900 dark:border-slate-700">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs uppercase tracking-wider text-ink-400 bg-paper">
                        <th class="px-5 py-3 font-semibold">#</th>
                        <th class="px-5 py-3 font-semibold">Nama Supplier</th>
                        <th class="px-5 py-3 font-semibold">Kontak</th>
                        <th class="px-5 py-3 font-semibold">Alamat</th>
                        <th class="px-5 py-3 font-semibold">Jumlah Produk</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100">
                    @forelse ($suppliers as $supplier)
                        <tr class="hover:bg-paper/60">
                            <td class="px-5 py-3 text-ink-400">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 font-medium text-ink-700">{{ $supplier->nama_supplier }}</td>
                            <td class="px-5 py-3 text-ink-500">{{ $supplier->kontak ?? '-' }}</td>
                            <td class="px-5 py-3 text-ink-500">{{ $supplier->alamat ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center rounded-full bg-leaf-50 text-leaf-600 text-xs font-semibold px-2.5 py-1">{{ $supplier->produk_count }} produk</span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('supplier.edit', $supplier) }}"
                                       class="rounded-md border border-mustard-300 text-mustard-700 hover:bg-mustard-50 text-xs font-semibold px-3 py-1.5 transition-colors">Edit</a>
                                    <form action="{{ route('supplier.destroy', $supplier) }}" method="POST"
                                          onsubmit="return confirm('Hapus supplier ini?')">
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
                            <td colspan="6" class="px-5 py-10 text-center text-ink-400">
                                @if ($search)
                                    Tidak ada supplier yang cocok dengan "{{ $search }}".
                                @else
                                    Belum ada data supplier.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($suppliers->hasPages())
            <div class="px-5 py-4 border-t border-ink-100">
                {{ $suppliers->links() }}
            </div>
        @endif
    </div>
@endsection
