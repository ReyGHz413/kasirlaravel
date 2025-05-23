<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pembelian');
            $table->integer('total_pembelian');
            $table->integer('keuntungan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('notas');
    }
};