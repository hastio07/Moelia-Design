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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('telephone1_name')->nullable();
            $table->string('telephone1_number')->nullable();
            $table->string('telephone2_name')->nullable();
            $table->string('telephone2_number')->nullable();
            $table->string('whatsapp1_name')->nullable();
            $table->string('whatsapp1_number')->nullable();
            $table->string('whatsapp2_name')->nullable();
            $table->string('whatsapp2_number')->nullable();
            $table->string('whatsapp3_name')->nullable();
            $table->string('whatsapp3_number')->nullable();
            $table->string('whatsapp4_name')->nullable();
            $table->string('whatsapp4_number')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('contacts');
    }
};
