<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerAndStockFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_customer(): void
    {
        $response = $this->post(route('pelanggan.store'), [
            'nama_pelanggan' => 'Budi',
            'telepon' => '08123456789',
            'alamat' => 'Jl. Raya',
        ]);

        $response->assertRedirect(route('pelanggan.index'));
        $this->assertDatabaseHas('pelanggans', ['nama_pelanggan' => 'Budi']);
    }

    public function test_can_create_stock_movement_and_update_stock(): void
    {
        $kategori = Kategori::create(['nama_kategori' => 'Sembako']);
        $produk = Produk::create([
            'kategori_id' => $kategori->id,
            'supplier_id' => null,
            'kode_produk' => 'P002',
            'nama_produk' => 'Minyak',
            'harga' => 12000,
            'stok' => 5,
        ]);

        $response = $this->post(route('stok-movement.store'), [
            'produk_id' => $produk->id,
            'jenis' => 'masuk',
            'jumlah' => 3,
            'keterangan' => 'Restock',
        ]);

        $response->assertRedirect(route('stok-movement.index'));
        $this->assertEquals(8, $produk->fresh()->stok);
    }
}
