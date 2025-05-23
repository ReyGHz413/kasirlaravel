<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Models\Barang;
use App\Models\DetailNota;

class Nota extends Model
{
    protected $fillable = ['tanggal_pembelian', 'total_pembelian', 'keuntungan'];

    public function detailnota() {
        return $this->hasMany(DetailNota::class);
    }

    public function barang(): HasManyThrough
{
    return $this->hasManyThrough(Barang::class, DetailNota::class, 'nota_id', 'id', 'id', 'barang_id');
}
}


