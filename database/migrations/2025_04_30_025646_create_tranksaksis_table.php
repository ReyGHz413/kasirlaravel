<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tranksaksis', function (Blueprint $table) {
            $table->id();
            $table->string('id_barang');
            $table->string('nominal_diskon');
            $table->string('harga_asli');
            $table->string('harga_diskon');
            $table->string('keuntungan');
            $table->string('total_pembelian');
            $table->string('tanggal_beli');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tranksaksis');
    }
};
