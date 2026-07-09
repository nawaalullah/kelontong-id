<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')
                  ->constrained('kategoris')
                  ->onDelete('cascade');
            $table->foreignId('supplier_id')
                  ->nullable()
                  ->constrained('suppliers')
                  ->onDelete('set null');
            $table->string('kode_produk')->unique();
            $table->string('nama_produk');
            $table->integer('harga');
            $table->integer('stok')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
