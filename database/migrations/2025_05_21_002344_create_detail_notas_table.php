<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('detail_notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nota_id')->constrained('notas')->onDelete('restrict');
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('restrict');
            $table->integer('jumlah');
            $table->decimal('diskon')->default(0); // dalam persen
            $table->integer('harga_asli');
            $table->integer('harga_diskon');
            $table->integer('subtotal');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('detail_notas');
    }
};