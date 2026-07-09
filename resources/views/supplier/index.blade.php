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

    <div class="rounded-xl bg-white border border-ink-100 shadow-paper overflow-hidden">
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
                            <td colspan="6" class="px-5 py-10 text-center text-ink-400">Belum ada data supplier.</td>
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
