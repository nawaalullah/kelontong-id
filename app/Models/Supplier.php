<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_supplier',
        'kontak',
        'alamat',
    ];

    /**
     * Satu supplier memasok banyak produk.
     */
    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class);
    }
}
