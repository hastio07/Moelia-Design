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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('alamat_domisili');
            $table->string('kontak');
            $table->decimal('besaran_gaji', 10, 0, true);
            $table->foreignId('jabatan')->constrained('category_jabatans', 'id')->restrictOnDelete()->cascadeOnUpdate();
            $table->string('show_data')->default('tidak');
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('employees');
    }
};
