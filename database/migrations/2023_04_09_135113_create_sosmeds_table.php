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
        Schema::create('sosmeds', function (Blueprint $table) {
            $table->id();
            $table->string('u_instagram')->nullable();
            $table->string('l_instagram')->nullable();
            $table->string('u_facebook')->nullable();
            $table->string('l_facebook')->nullable();
            $table->string('u_twitter')->nullable();
            $table->string('l_twitter')->nullable();
            $table->string('u_tiktok')->nullable();
            $table->string('l_tiktok')->nullable();
            $table->string('u_youtube')->nullable();
            $table->string('l_youtube')->nullable();
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
        Schema::dropIfExists('sosmeds');
    }
};
