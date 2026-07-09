<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'supplier_id',
        'kode_produk',
        'nama_produk',
        'harga',
        'stok',
        'tanggal_kadaluarsa',
    ];

    protected $casts = [
        'tanggal_kadaluarsa' => 'date',
    ];

    /**
     * Jumlah hari (batas) yang dianggap "akan kadaluarsa" untuk peringatan dashboard.
     */
    public const BATAS_HARI_AKAN_KADALUARSA = 30;

    /**
     * Scope: produk yang sudah lewat tanggal kadaluarsanya.
     */
    public function scopeSudahKadaluarsa($query)
    {
        return $query->whereNotNull('tanggal_kadaluarsa')
            ->whereDate('tanggal_kadaluarsa', '<', now()->toDateString());
    }

    /**
     * Scope: produk yang akan kadaluarsa dalam N hari ke depan (belum lewat).
     */
    public function scopeAkanKadaluarsa($query, int $hari = self::BATAS_HARI_AKAN_KADALUARSA)
    {
        return $query->whereNotNull('tanggal_kadaluarsa')
            ->whereDate('tanggal_kadaluarsa', '>=', now()->toDateString())
            ->whereDate('tanggal_kadaluarsa', '<=', now()->addDays($hari)->toDateString());
    }

    /**
     * Status kadaluarsa produk ini: 'expired', 'segera', atau 'aman'.
     */
    public function getStatusKadaluarsaAttribute(): ?string
    {
        if (! $this->tanggal_kadaluarsa) {
            return null;
        }

        if ($this->tanggal_kadaluarsa->isPast()) {
            return 'expired';
        }

        if (now()->startOfDay()->diffInDays($this->tanggal_kadaluarsa->copy()->startOfDay()) <= self::BATAS_HARI_AKAN_KADALUARSA) {
            return 'segera';
        }

        return 'aman';
    }

    /**
     * Teks sisa waktu menuju kadaluarsa yang dibulatkan & otomatis pakai satuan
     * hari / bulan / tahun (mis. "12 hari lagi", "2 bulan lagi", "1 tahun lagi").
     * Hanya berarti untuk produk yang belum kadaluarsa.
     */
    public function getSisaKadaluarsaTextAttribute(): ?string
    {
        if (! $this->tanggal_kadaluarsa || $this->tanggal_kadaluarsa->isPast()) {
            return null;
        }

        $sekarang = now()->startOfDay();
        $target   = $this->tanggal_kadaluarsa->copy()->startOfDay();

        $hari = (int) $sekarang->diffInDays($target);

        if ($hari < 30) {
            return $hari . ' hari lagi';
        }

        $bulan = (int) $sekarang->diffInMonths($target);

        if ($bulan < 12) {
            return $bulan . ' bulan lagi';
        }

        $tahun = (int) $sekarang->diffInYears($target);

        return $tahun . ' tahun lagi';
    }

    /**
     * Setiap produk dimiliki oleh satu kategori.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Setiap produk dipasok oleh satu supplier (opsional).
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Riwayat baris transaksi yang memuat produk ini.
     */
    public function transaksiDetail(): HasMany
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
