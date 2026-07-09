@extends('layouts.app')

@section('eyebrow', 'Ringkasan')
@section('title', 'Dashboard & Laporan')

@section('content')

    <div class="grid grid-cols-4 gap-2 sm:gap-4 mb-4">
        <div class="aspect-square sm:aspect-auto rounded-xl bg-ink-700 text-white p-2 sm:p-5 shadow-paper flex flex-col items-center justify-center text-center sm:items-start sm:justify-start sm:text-left">
            <p class="text-[9px] sm:text-xs uppercase tracking-widest text-ink-300 leading-tight">Total Produk</p>
            <p class="font-display font-semibold text-lg sm:text-3xl mt-1 sm:mt-2">{{ $totalProduk }}</p>
        </div>
        <div class="aspect-square sm:aspect-auto rounded-xl bg-leaf-500 text-white p-2 sm:p-5 shadow-paper flex flex-col items-center justify-center text-center sm:items-start sm:justify-start sm:text-left">
            <p class="text-[9px] sm:text-xs uppercase tracking-widest text-leaf-50/80 leading-tight">Total Transaksi</p>
            <p class="font-display font-semibold text-lg sm:text-3xl mt-1 sm:mt-2">{{ $totalTransaksi }}</p>
        </div>
        <div class="aspect-square sm:aspect-auto rounded-xl bg-leaf-600 text-white p-2 sm:p-5 shadow-paper flex flex-col items-center justify-center text-center sm:items-start sm:justify-start sm:text-left">
            <p class="text-[9px] sm:text-xs uppercase tracking-widest text-leaf-100/80 leading-tight">Transaksi Hari Ini</p>
            <p class="font-display font-semibold text-lg sm:text-3xl mt-1 sm:mt-2">{{ $totalTransaksiHariIni }}</p>
        </div>
        <div class="aspect-square sm:aspect-auto rounded-xl bg-mustard-400 text-ink-800 p-2 sm:p-5 shadow-paper flex flex-col items-center justify-center text-center sm:items-start sm:justify-start sm:text-left">
            <p class="text-[9px] sm:text-xs uppercase tracking-widest text-ink-700/70 leading-tight">Total Pendapatan</p>
            <p class="font-display font-semibold text-[11px] sm:text-xl lg:text-2xl mt-1 sm:mt-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="aspect-square sm:aspect-auto rounded-xl bg-clay-500 text-white p-2 sm:p-5 shadow-paper flex flex-col items-center justify-center text-center sm:items-start sm:justify-start sm:text-left">
            <p class="text-[9px] sm:text-xs uppercase tracking-widest text-clay-50/80 leading-tight">Stok Menipis (&le;5)</p>
            <p class="font-display font-semibold text-lg sm:text-3xl mt-1 sm:mt-2">{{ $produkStokMenipis }}</p>
        </div>
        <div class="aspect-square sm:aspect-auto rounded-xl bg-clay-700 text-white p-2 sm:p-5 shadow-paper flex flex-col items-center justify-center text-center sm:items-start sm:justify-start sm:text-left">
            <p class="text-[9px] sm:text-xs uppercase tracking-widest text-clay-100/80 leading-tight">Stok Habis</p>
            <p class="font-display font-semibold text-lg sm:text-3xl mt-1 sm:mt-2">{{ $produkStokHabis }}</p>
        </div>
        <div class="aspect-square sm:aspect-auto rounded-xl bg-mustard-500 text-white p-2 sm:p-5 shadow-paper flex flex-col items-center justify-center text-center sm:items-start sm:justify-start sm:text-left">
            <p class="text-[9px] sm:text-xs uppercase tracking-widest text-white/80 leading-tight">Akan Kadaluarsa (&le;30 hr)</p>
            <p class="font-display font-semibold text-lg sm:text-3xl mt-1 sm:mt-2">{{ $produkAkanKadaluarsa }}</p>
        </div>
        <div class="aspect-square sm:aspect-auto rounded-xl bg-ink-800 text-white p-2 sm:p-5 shadow-paper flex flex-col items-center justify-center text-center sm:items-start sm:justify-start sm:text-left">
            <p class="text-[9px] sm:text-xs uppercase tracking-widest text-clay-300 leading-tight">Sudah Kadaluarsa</p>
            <p class="font-display font-semibold text-lg sm:text-3xl mt-1 sm:mt-2">{{ $produkSudahKadaluarsa }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="rounded-xl bg-white border border-ink-100 p-5 shadow-paper">
            <p class="text-xs uppercase tracking-widest text-ink-400">Penjualan Hari Ini</p>
            <p class="font-display font-semibold text-2xl mt-2 text-ink-700">Rp {{ number_format($totalPenjualanHariIni, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-xl bg-white border border-ink-100 p-5 shadow-paper">
            <p class="text-xs uppercase tracking-widest text-ink-400">Cash Hari Ini</p>
            <p class="font-display font-semibold text-2xl mt-2 text-mustard-600">Rp {{ number_format($totalCashHariIni, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-xl bg-white border border-ink-100 p-5 shadow-paper">
            <p class="text-xs uppercase tracking-widest text-ink-400">QRIS Hari Ini</p>
            <p class="font-display font-semibold text-2xl mt-2 text-leaf-600">Rp {{ number_format($totalQrisHariIni, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-5 mb-8">
        <div class="lg:col-span-3 rounded-xl bg-white border border-ink-100 shadow-paper">
            <div class="px-5 py-4 border-b border-ink-100">
                <h2 class="font-display font-semibold text-ink-700">Penjualan 7 Hari Terakhir (Cash vs QRIS)</h2>
            </div>
            <div class="p-5">
                <div class="relative h-64 sm:h-72">
                    <canvas id="chartPenjualan"></canvas>
                </div>
            </div>
        </div>
        <div class="lg:col-span-2 rounded-xl bg-white border border-ink-100 shadow-paper">
            <div class="px-5 py-4 border-b border-ink-100">
                <h2 class="font-display font-semibold text-ink-700">5 Produk Terlaris</h2>
            </div>
            <div class="p-5">
                <div class="relative h-64 sm:h-72">
                    <canvas id="chartTerlaris"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 mb-5">
        <div class="rounded-xl bg-white border border-ink-100 shadow-paper overflow-hidden">
            <div class="px-5 py-4 border-b border-ink-100">
                <h2 class="font-display font-semibold text-ink-700">Produk dengan Stok Menipis</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs uppercase tracking-wider text-ink-400 bg-paper">
                            <th class="px-5 py-3 font-semibold">Produk</th>
                            <th class="px-5 py-3 font-semibold">Kategori</th>
                            <th class="px-5 py-3 font-semibold">Sisa Stok</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ink-100">
                        @forelse ($stokMenipis as $produk)
                            <tr class="hover:bg-paper/60">
                                <td class="px-5 py-3 text-ink-700">{{ $produk->nama_produk }}</td>
                                <td class="px-5 py-3 text-ink-500">{{ $produk->kategori->nama_kategori }}</td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex items-center rounded-full bg-clay-50 text-clay-600 text-xs font-semibold px-2.5 py-1">{{ $produk->stok }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-5 py-8 text-center text-ink-400">Semua stok aman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="rounded-xl bg-white border border-ink-100 shadow-paper overflow-hidden">
            <div class="px-5 py-4 border-b border-ink-100">
                <h2 class="font-display font-semibold text-ink-700">Produk dengan Stok Habis</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs uppercase tracking-wider text-ink-400 bg-paper">
                            <th class="px-5 py-3 font-semibold">Produk</th>
                            <th class="px-5 py-3 font-semibold">Kategori</th>
                            <th class="px-5 py-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ink-100">
                        @forelse ($stokHabis as $produk)
                            <tr class="hover:bg-paper/60">
                                <td class="px-5 py-3 text-ink-700">{{ $produk->nama_produk }}</td>
                                <td class="px-5 py-3 text-ink-500">{{ $produk->kategori->nama_kategori }}</td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex items-center rounded-full bg-clay-100 text-clay-700 text-xs font-semibold px-2.5 py-1">Stok habis</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-5 py-8 text-center text-ink-400">Tidak ada produk yang stoknya habis.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
        <div class="rounded-xl bg-white border border-ink-100 shadow-paper overflow-hidden">
            <div class="px-5 py-4 border-b border-ink-100">
                <h2 class="font-display font-semibold text-ink-700">Produk Akan / Sudah Kadaluarsa</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs uppercase tracking-wider text-ink-400 bg-paper">
                            <th class="px-5 py-3 font-semibold">Produk</th>
                            <th class="px-5 py-3 font-semibold">Kategori</th>
                            <th class="px-5 py-3 font-semibold">Tgl. Kadaluarsa</th>
                            <th class="px-5 py-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ink-100">
                        @forelse ($produkKadaluarsa as $produk)
                            <tr class="hover:bg-paper/60">
                                <td class="px-5 py-3 text-ink-700">{{ $produk->nama_produk }}</td>
                                <td class="px-5 py-3 text-ink-500">{{ $produk->kategori->nama_kategori }}</td>
                                <td class="px-5 py-3 font-mono text-ink-500">{{ $produk->tanggal_kadaluarsa->format('d-m-Y') }}</td>
                                <td class="px-5 py-3">
                                    @if ($produk->status_kadaluarsa === 'expired')
                                        <span class="inline-flex items-center rounded-full bg-clay-50 text-clay-600 text-xs font-semibold px-2.5 py-1">Sudah kadaluarsa</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-mustard-100 text-mustard-700 text-xs font-semibold px-2.5 py-1">{{ $produk->sisa_kadaluarsa_text }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-8 text-center text-ink-400">Tidak ada produk yang akan kadaluarsa dalam 30 hari.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        const labelPenjualan = @json($labelPenjualan);
        const dataCash       = @json($dataCash);
        const dataQris       = @json($dataQris);
        const labelTerlaris  = @json($labelTerlaris);
        const dataTerlaris   = @json($dataTerlaris);

        const chartPenjualan = new Chart(document.getElementById('chartPenjualan'), {
            type: 'bar',
            data: {
                labels: labelPenjualan,
                datasets: [
                    {
                        label: 'Cash',
                        data: dataCash,
                        backgroundColor: '#DDAF3E',
                        borderRadius: 4,
                        stack: 'penjualan',
                    },
                    {
                        label: 'QRIS',
                        data: dataQris,
                        backgroundColor: '#2F5233',
                        borderRadius: 4,
                        stack: 'penjualan',
                    },
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: 'top', labels: { boxWidth: 12, usePointStyle: true } },
                    tooltip: {
                        callbacks: {
                            label: (ctx) => `${ctx.dataset.label}: Rp ${Number(ctx.raw).toLocaleString('id-ID')}`
                        }
                    }
                },
                scales: {
                    y: { stacked: true, grid: { color: '#EDF1EE' } },
                    x: { stacked: true, grid: { display: false } }
                }
            }
        });

        const chartTerlaris = new Chart(document.getElementById('chartTerlaris'), {
            type: 'bar',
            data: {
                labels: labelTerlaris,
                datasets: [{
                    label: 'Jumlah Terjual',
                    data: dataTerlaris,
                    backgroundColor: '#DDAF3E',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { grid: { color: '#EDF1EE' } }, x: { grid: { display: false } } }
            }
        });

        // Chart.js kadang gagal menyesuaikan ukuran otomatis setelah viewport
        // berubah drastis (mis. keluar dari mode HP di DevTools, putar layar,
        // atau halaman dipulihkan dari cache back/forward). Paksa resize
        // manual supaya tidak perlu refresh halaman.
        function segarkanUkuranChart() {
            chartPenjualan.resize();
            chartTerlaris.resize();
        }

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(segarkanUkuranChart, 150);
        });
        window.addEventListener('orientationchange', segarkanUkuranChart);
        window.addEventListener('pageshow', segarkanUkuranChart);
        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) segarkanUkuranChart();
        });
    </script>
@endsection
