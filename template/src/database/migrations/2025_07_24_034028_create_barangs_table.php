<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang')->nullable();
            $table->string('kode_barang')->nullable();
            $table->integer('stok')->nullable();
            $table->decimal('harga', 10, 2)->nullable();
            $table->string('kategori')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
