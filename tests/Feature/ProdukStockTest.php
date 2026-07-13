<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProdukStockTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_add_stock_to_product(): void
    {
        $kategori = Kategori::create([
            'nama_kategori' => 'Sembako',
        ]);

        $produk = Produk::create([
            'kategori_id' => $kategori->id,
            'supplier_id' => null,
            'kode_produk' => 'P001',
            'nama_produk' => 'Beras',
            'harga' => 15000,
            'stok' => 10,
        ]);

        $response = $this->post(route('produk.tambah-stok', $produk), [
            'jumlah' => 5,
        ]);

        $response->assertRedirect(route('produk.index'));
        $this->assertEquals(15, $produk->fresh()->stok);
    }
}
