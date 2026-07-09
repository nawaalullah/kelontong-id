@extends('layouts.app')

@section('eyebrow', 'Kasir')
@section('title', 'Transaksi')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <p class="text-ink-500 text-sm">Riwayat nota penjualan yang sudah tercatat.</p>
        <a href="{{ route('transaksi.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-mustard-400 hover:bg-mustard-500 text-ink-800 font-semibold text-sm px-4 py-2.5 shadow-paper transition-colors">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            Transaksi Baru
        </a>
    </div>

    <div class="rounded-xl bg-white border border-ink-100 shadow-paper overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs uppercase tracking-wider text-ink-400 bg-paper">
                        <th class="px-5 py-3 font-semibold">#</th>
                        <th class="px-5 py-3 font-semibold">No. Transaksi</th>
                        <th class="px-5 py-3 font-semibold">Pelanggan</th>
                        <th class="px-5 py-3 font-semibold">Jumlah Item</th>
                        <th class="px-5 py-3 font-semibold">Total</th>
                        <th class="px-5 py-3 font-semibold">Pembayaran</th>
                        <th class="px-5 py-3 font-semibold">Tanggal</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100">
                    @forelse ($transaksis as $transaksi)
                        <tr class="hover:bg-paper/60">
                            <td class="px-5 py-3 text-ink-400">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 font-mono text-xs text-ink-700">{{ $transaksi->no_transaksi }}</td>
                            <td class="px-5 py-3 text-ink-500">{{ $transaksi->nama_pelanggan ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center rounded-full bg-ink-50 text-ink-500 text-xs font-semibold px-2.5 py-1">{{ $transaksi->detail_count }} item</span>
                            </td>
                            <td class="px-5 py-3 font-mono font-semibold text-ink-700">Rp {{ number_format($transaksi->total_keseluruhan, 0, ',', '.') }}</td>
                            <td class="px-5 py-3">
                                @if ($transaksi->metode_pembayaran === 'qris')
                                    <span class="inline-flex items-center rounded-full bg-leaf-50 text-leaf-600 text-xs font-semibold px-2.5 py-1">QRIS</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-mustard-100 text-mustard-700 text-xs font-semibold px-2.5 py-1">Cash</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-ink-500">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y') }}</td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('transaksi.show', $transaksi) }}"
                                       class="rounded-md border border-leaf-300 text-leaf-600 hover:bg-leaf-50 text-xs font-semibold px-3 py-1.5 transition-colors">Lihat Struk</a>
                                    <form action="{{ route('transaksi.destroy', $transaksi) }}" method="POST"
                                          onsubmit="return confirm('Hapus transaksi ini? Stok semua item akan dikembalikan.')">
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
                            <td colspan="8" class="px-5 py-10 text-center text-ink-400">Belum ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($transaksis->hasPages())
            <div class="px-5 py-4 border-t border-ink-100">
                {{ $transaksis->links() }}
            </div>
        @endif
    </div>
@endsection
