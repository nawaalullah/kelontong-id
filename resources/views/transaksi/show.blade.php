@extends('layouts.app')

@section('eyebrow', 'Kasir')
@section('title', 'Detail Struk')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
            <p class="text-ink-500 text-sm dark:text-slate-300">Rincian nota penjualan.</p>
            <a href="{{ route('transaksi.index') }}"
               class="inline-flex items-center gap-1.5 rounded-lg border border-ink-100 text-ink-500 hover:bg-white text-sm font-medium px-4 py-2.5 transition-colors dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">
            Kembali
        </a>
    </div>

    <div class="max-w-md mx-auto">
        <div class="relative bg-white shadow-paper rounded-t-lg overflow-hidden dark:bg-slate-900 dark:border dark:border-slate-700">
            <div class="absolute inset-x-0 top-0 h-1.5 bg-mustard-400"></div>

            <div class="px-6 pt-8 pb-5 text-center border-b border-dashed border-ink-200">
                <span class="inline-flex w-12 h-12 rounded-lg bg-mustard-400 items-center justify-center">
                    <svg class="w-6 h-6 text-ink-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 9h16l-1.4 9.8A2 2 0 0 1 16.62 20.6H7.38a2 2 0 0 1-1.98-1.8L4 9Z"/>
                        <path d="M8 9V6.5a4 4 0 0 1 8 0V9"/>
                        <path d="M9 13v4M12 13v4M15 13v4"/>
                    </svg>
                </span>
                <p class="font-display font-semibold text-lg text-ink-700 mt-2">Kelontong.id</p>
                <p class="text-xs text-ink-400 mt-0.5">Nota Penjualan</p>
            </div>

            <div class="px-6 py-5 font-mono text-xs text-ink-600 space-y-1 border-b border-dashed border-ink-200 dark:text-slate-300 dark:border-slate-700">
                <div class="flex justify-between"><span class="text-ink-400 dark:text-slate-400">No. Transaksi</span><span class="text-ink-700 dark:text-slate-100">{{ $transaksi->no_transaksi }}</span></div>
                <div class="flex justify-between"><span class="text-ink-400 dark:text-slate-400">Tanggal</span><span class="text-ink-700 dark:text-slate-100">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y') }}</span></div>
                <div class="flex justify-between"><span class="text-ink-400 dark:text-slate-400">Pelanggan</span><span class="text-ink-700 dark:text-slate-100">{{ $transaksi->nama_pelanggan ?? '-' }}</span></div>
                <div class="flex justify-between"><span class="text-ink-400 dark:text-slate-400">Pembayaran</span><span class="text-ink-700 dark:text-slate-100">{{ $transaksi->metode_pembayaran === 'qris' ? 'QRIS' : 'Cash' }}</span></div>
            </div>

            <div class="px-6 py-5 border-b border-dashed border-ink-200 dark:border-slate-700">
                <table class="w-full text-xs font-mono">
                    <thead>
                        <tr class="text-ink-400 dark:text-slate-400 border-b border-ink-100 dark:border-slate-700">
                            <th class="text-left font-semibold pb-2">Produk</th>
                            <th class="text-right font-semibold pb-2">Harga</th>
                            <th class="text-right font-semibold pb-2">Jml</th>
                            <th class="text-right font-semibold pb-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ink-50 dark:divide-slate-700">
                        @foreach ($transaksi->detail as $item)
                            <tr>
                                <td class="py-2 text-ink-700 dark:text-slate-100">{{ $item->produk->nama_produk ?? 'Produk telah dihapus' }}</td>
                                <td class="py-2 text-right text-ink-500 dark:text-slate-300">{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                <td class="py-2 text-right text-ink-500 dark:text-slate-300">{{ $item->jumlah }}</td>
                                <td class="py-2 text-right text-ink-700 dark:text-slate-100">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-5 flex items-center justify-between">
                <span class="font-display font-semibold text-ink-700">Total</span>
                <span class="font-mono font-bold text-lg text-ink-700">Rp {{ number_format($transaksi->total_keseluruhan, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- perforated receipt edge --}}
        <div class="h-4" style="background-image: radial-gradient(circle at 8px 0, transparent 8px, #F7F3E8 8px); background-size: 16px 16px; background-repeat: repeat-x; background-position: top;"></div>
        <p class="text-center text-[11px] text-ink-300 mt-3">Terima kasih telah berbelanja 🙏</p>
    </div>
@endsection
