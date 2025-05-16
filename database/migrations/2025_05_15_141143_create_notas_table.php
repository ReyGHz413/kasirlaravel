<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id');
            $table->integer('jumlah');
            $table->decimal('nominal_diskon'); // Diskon dalam persen (1% - 100%)
            $table->integer('harga_asli');
            $table->integer('harga_diskon');
            $table->integer('total_pembelian');
            $table->integer('keuntungan');
            $table->date('tanggal_pembelian');
            $table->timestamps();

            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
