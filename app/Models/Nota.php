<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = [
        'barang_id',
        'jumlah',
        'nominal_diskon',
        'harga_asli',
        'harga_diskon',
        'total_pembelian',
        'keuntungan',
        'tanggal_pembelian',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
    
    public function getHargaTerbaruAttribute()
{
    return $this->barang->harga;
}
}
