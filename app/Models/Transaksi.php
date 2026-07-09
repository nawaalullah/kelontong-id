<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaksi',
        'tanggal_transaksi',
        'nama_pelanggan',
        'total_keseluruhan',
        'metode_pembayaran',
    ];

    /**
     * Label tampilan untuk metode pembayaran.
     */
    public function getMetodePembayaranLabelAttribute(): string
    {
        return $this->metode_pembayaran === 'qris' ? 'QRIS' : 'Cash';
    }

    /**
     * Satu nota transaksi punya banyak baris item (produk).
     */
    public function detail(): HasMany
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
