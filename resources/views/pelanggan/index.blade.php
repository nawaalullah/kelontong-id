@extends('layouts.app')

@section('eyebrow', 'Master Data')
@section('title', 'Pelanggan')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <p class="text-ink-500 text-sm">Daftar pelanggan yang sering berbelanja di toko Anda.</p>
        <a href="{{ route('pelanggan.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-mustard-400 hover:bg-mustard-500 text-ink-800 font-semibold text-sm px-4 py-2.5 shadow-paper transition-colors">Tambah Pelanggan</a>
    </div>

    <form action="{{ route('pelanggan.index') }}" method="GET" class="flex items-center gap-3 mb-4">
        <div class="relative flex-1 max-w-xs">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama pelanggan..." class="w-full rounded-lg border border-ink-100 bg-white px-3 py-2 text-sm text-ink-700">
        </div>
        <button type="submit" class="rounded-lg bg-ink-700 hover:bg-ink-800 text-white text-sm font-semibold px-4 py-2 transition-colors">Cari</button>
    </form>

    <div class="rounded-xl bg-white border border-ink-100 shadow-paper overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs uppercase tracking-wider text-ink-400 bg-paper">
                        <th class="px-5 py-3 font-semibold">#</th>
                        <th class="px-5 py-3 font-semibold">Nama</th>
                        <th class="px-5 py-3 font-semibold">Telepon</th>
                        <th class="px-5 py-3 font-semibold">Alamat</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100">
                    @forelse ($pelanggans as $pelanggan)
                        <tr class="hover:bg-paper/60">
                            <td class="px-5 py-3 text-ink-400">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 font-medium text-ink-700">{{ $pelanggan->nama_pelanggan }}</td>
                            <td class="px-5 py-3 text-ink-500">{{ $pelanggan->telepon ?? '-' }}</td>
                            <td class="px-5 py-3 text-ink-500">{{ $pelanggan->alamat ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('pelanggan.edit', $pelanggan) }}" class="rounded-md border border-mustard-300 text-mustard-700 hover:bg-mustard-50 text-xs font-semibold px-3 py-1.5 transition-colors">Edit</a>
                                    <form action="{{ route('pelanggan.destroy', $pelanggan) }}" method="POST" onsubmit="return confirm('Hapus pelanggan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-md border border-clay-300 text-clay-600 hover:bg-clay-50 text-xs font-semibold px-3 py-1.5 transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-10 text-center text-ink-400">Belum ada data pelanggan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($pelanggans->hasPages())
            <div class="px-5 py-4 border-t border-ink-100">{{ $pelanggans->links() }}</div>
        @endif
    </div>
@endsection
