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
        Schema::create('cal_all_ins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('admins', 'id')->restrictOnDelete()->restrictOnUpdate();
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
        Schema::dropIfExists('cal_all_ins');
    }
};
