@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
    <h3 class="mb-3">Edit Transaksi</h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('transaksi.update', $transaksi) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Produk</label>
                    <input type="text" class="form-control" value="{{ $transaksi->produk->nama_produk }}" disabled>
                    <div class="form-text">Produk tidak dapat diubah. Hapus transaksi dan buat baru jika ingin ganti produk.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $transaksi->jumlah) }}" min="1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Transaksi</label>
                    <input type="date" name="tanggal_transaksi" class="form-control" value="{{ old('tanggal_transaksi', \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('Y-m-d')) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
