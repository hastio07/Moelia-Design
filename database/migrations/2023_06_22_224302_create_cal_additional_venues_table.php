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
        Schema::create('cal_additional_venues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('admins', 'id')->restrictOnDelete()->restrictOnUpdate();
            $table->foreignId('kategori_id')->constrained('category_additional_venues', 'id')->restrictOnDelete()->cascadeOnUpdate();
            $table->string('nama_paket');
            $table->decimal('harga', 10, 0, true);
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
        Schema::dropIfExists('cal_additional_venues');
    }
};
