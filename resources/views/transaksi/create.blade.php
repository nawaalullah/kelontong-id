@extends('layouts.app')

@section('eyebrow', 'Kasir')
@section('title', 'Transaksi Baru')

@section('content')
    <div class="max-w-4xl">
        <div class="rounded-xl bg-white border border-ink-100 shadow-paper p-6">
            <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-ink-700 mb-1.5">Nama Pelanggan (opsional)</label>
                        <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}"
                               class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-ink-700 mb-1.5">Tanggal Transaksi</label>
                        <input type="date" name="tanggal_transaksi" value="{{ old('tanggal_transaksi', date('Y-m-d')) }}" required
                               class="w-full rounded-lg border border-ink-100 bg-paper/40 px-3.5 py-2.5 text-sm text-ink-700 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Metode Pembayaran</label>
                    <div class="grid grid-cols-2 gap-3 max-w-xs">
                        <label class="metode-option relative flex items-center justify-center rounded-lg border-2 border-mustard-400 bg-mustard-50 px-4 py-3 text-sm font-semibold text-ink-700 cursor-pointer transition-colors">
                            <input type="radio" name="metode_pembayaran" value="cash"
                                   {{ old('metode_pembayaran', 'cash') === 'cash' ? 'checked' : '' }}
                                   class="metode-radio absolute opacity-0 inset-0 cursor-pointer">
                            Cash
                        </label>
                        <label class="metode-option relative flex items-center justify-center rounded-lg border-2 border-ink-100 px-4 py-3 text-sm font-semibold text-ink-500 cursor-pointer transition-colors">
                            <input type="radio" name="metode_pembayaran" value="qris"
                                   {{ old('metode_pembayaran') === 'qris' ? 'checked' : '' }}
                                   class="metode-radio absolute opacity-0 inset-0 cursor-pointer">
                            QRIS
                        </label>
                    </div>
                </div>

                <div class="border-t border-dashed border-ink-100 pt-5 mb-3">
                    <h2 class="font-display font-semibold text-ink-700 mb-3">Daftar Item</h2>
                </div>

                <div class="rounded-lg border border-ink-100 overflow-hidden mb-3">
                    <table class="w-full text-sm" id="tabelItem">
                        <thead>
                            <tr class="text-left text-xs uppercase tracking-wider text-ink-400 bg-paper">
                                <th class="px-4 py-2.5 font-semibold" style="width: 42%">Produk</th>
                                <th class="px-4 py-2.5 font-semibold" style="width: 15%">Jumlah</th>
                                <th class="px-4 py-2.5 font-semibold" style="width: 25%">Subtotal</th>
                                <th class="px-4 py-2.5 font-semibold" style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody id="bodyItem" class="divide-y divide-ink-100">
                            {{-- baris item ditambahkan lewat JS --}}
                        </tbody>
                    </table>
                </div>

                <button type="button" id="btnTambahBaris"
                        class="inline-flex items-center gap-1.5 rounded-md border border-mustard-300 text-mustard-700 hover:bg-mustard-50 text-xs font-semibold px-3 py-2 mb-6 transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
                    Tambah Item
                </button>

                <div class="flex justify-end mb-6">
                    <div class="text-right">
                        <p class="text-xs uppercase tracking-widest text-ink-400">Total</p>
                        <p class="font-display font-semibold text-2xl text-ink-700">Rp <span id="grandTotal">0</span></p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit"
                            class="rounded-lg bg-mustard-400 hover:bg-mustard-500 text-ink-800 font-semibold text-sm px-5 py-2.5 shadow-paper transition-colors">Simpan Transaksi</button>
                    <a href="{{ route('transaksi.index') }}"
                       class="rounded-lg border border-ink-100 text-ink-500 hover:bg-paper text-sm font-medium px-5 py-2.5 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const produkList = @json($produkList);

        let rowIndex = 0;

        const inputClass = 'w-full rounded-md border border-ink-100 bg-paper/40 px-2.5 py-1.5 text-sm text-ink-700 focus:outline-none focus:ring-2 focus:ring-mustard-400 focus:border-mustard-400';

        function buatOptionProduk(selectedId = '') {
            let opts = '<option value="">-- Pilih Produk --</option>';
            produkList.forEach(p => {
                const selected = (String(p.id) === String(selectedId)) ? 'selected' : '';
                opts += `<option value="${p.id}" data-harga="${p.harga}" data-stok="${p.stok}" ${selected}>
                            ${p.nama} (Stok: ${p.stok}, Rp ${Number(p.harga).toLocaleString('id-ID')})
                         </option>`;
            });
            return opts;
        }

        function tambahBaris() {
            const tbody = document.getElementById('bodyItem');
            const tr = document.createElement('tr');
            tr.dataset.rowId = rowIndex;
            tr.className = 'align-top';

            tr.innerHTML = `
                <td class="px-4 py-2.5">
                    <select name="produk_id[]" class="produk-select ${inputClass}" required>
                        ${buatOptionProduk()}
                    </select>
                </td>
                <td class="px-4 py-2.5">
                    <input type="number" name="jumlah[]" class="jumlah-input ${inputClass}" value="1" min="1" required>
                </td>
                <td class="subtotal-cell px-4 py-2.5 font-mono text-ink-700">Rp 0</td>
                <td class="px-4 py-2.5">
                    <button type="button" class="btn-hapus-baris rounded-md border border-clay-300 text-clay-600 hover:bg-clay-50 w-8 h-8 flex items-center justify-center text-lg leading-none">&times;</button>
                </td>
            `;

            tbody.appendChild(tr);
            rowIndex++;
            attachRowEvents(tr);
        }

        function attachRowEvents(tr) {
            const select = tr.querySelector('.produk-select');
            const jumlahInput = tr.querySelector('.jumlah-input');
            const hapusBtn = tr.querySelector('.btn-hapus-baris');

            select.addEventListener('change', () => hitungBaris(tr));
            jumlahInput.addEventListener('input', () => hitungBaris(tr));
            hapusBtn.addEventListener('click', () => {
                tr.remove();
                hitungTotal();
            });
        }

        function hitungBaris(tr) {
            const select = tr.querySelector('.produk-select');
            const jumlahInput = tr.querySelector('.jumlah-input');
            const subtotalCell = tr.querySelector('.subtotal-cell');

            const opt = select.selectedOptions[0];
            const harga = opt ? parseInt(opt.dataset.harga || 0) : 0;
            const stok = opt ? parseInt(opt.dataset.stok || 0) : 0;
            let jumlah = parseInt(jumlahInput.value || 0);

            if (jumlah > stok) {
                jumlah = stok;
                jumlahInput.value = stok;
            }

            const subtotal = harga * jumlah;
            subtotalCell.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');

            hitungTotal();
        }

        function hitungTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal-cell').forEach(cell => {
                const angka = parseInt(cell.textContent.replace(/[^0-9]/g, '')) || 0;
                total += angka;
            });
            document.getElementById('grandTotal').textContent = total.toLocaleString('id-ID');
        }

        document.getElementById('btnTambahBaris').addEventListener('click', tambahBaris);

        tambahBaris();

        // Toggle tampilan pilihan metode pembayaran (cash / qris)
        function refreshMetodeStyle() {
            document.querySelectorAll('.metode-option').forEach(label => {
                const radio = label.querySelector('.metode-radio');
                if (radio.checked) {
                    label.classList.add('border-mustard-400', 'bg-mustard-50', 'text-ink-700');
                    label.classList.remove('border-ink-100', 'text-ink-500');
                } else {
                    label.classList.remove('border-mustard-400', 'bg-mustard-50', 'text-ink-700');
                    label.classList.add('border-ink-100', 'text-ink-500');
                }
            });
        }

        document.querySelectorAll('.metode-radio').forEach(radio => {
            radio.addEventListener('change', refreshMetodeStyle);
        });
        refreshMetodeStyle();

        document.getElementById('formTransaksi').addEventListener('submit', function (e) {
            const baris = document.querySelectorAll('#bodyItem tr');
            if (baris.length === 0) {
                e.preventDefault();
                alert('Tambahkan minimal 1 item produk.');
            }
        });
    </script>
@endsection
