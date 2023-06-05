<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('admins', 'id')->restrictOnDelete()->restrictOnUpdate();
            $table->string('nama_produk');
            $table->string('slug_produk')->unique();
            $table->foreignId('kategori_id')->constrained('category_products', 'id')->restrictOnDelete()->cascadeOnUpdate();
            $table->decimal('harga_sewa', 10, 0, true);
            $table->longText('rincian_produk');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
