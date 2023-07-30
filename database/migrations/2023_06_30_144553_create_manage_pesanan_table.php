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
        Schema::create('manage_pesanan', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_id');
            $table->foreignId('created_by')->constrained('admins', 'id')->restrictOnDelete()->cascadeOnUpdate();
            $table->string('nama_pemesan');
            $table->string('email_pemesan');
            $table->foreign('email_pemesan')->references('email')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->string('telepon_pemesan');
            $table->string('nama_pesanan');
            $table->date('tanggal_akad_dan_resepsi');
            $table->text('alamat_akad_dan_resepsi');
            $table->unsignedBigInteger('total_biaya_awal');
            $table->unsignedBigInteger('total_biaya_additional');
            $table->unsignedBigInteger('total_biaya_seluruh');
            $table->unsignedBigInteger('uang_muka');
            $table->longText('materi_kerja');
            $table->longText('additional');
            $table->longText('bonus');
            $table->string('snap_token')->nullable();
            $table->timestamp('snap_token_created_at')->nullable();
            $table->enum('jenis_pembayaran', ['dp', 'fp']);
            $table->enum('status', ['expire', 'pending', 'unpaid', 'paid', 'cancel'])->default('unpaid');
            $table->timestamp('waktu_pembayaran')->nullable();
            $table->dateTime('tanggal_konfirmasi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_pesanan');
    }
};
