<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tranksaksi extends Model
{
    protected $fillabel = [
        'id_barang',
        'nominal_diskon',
        'harga_asli',
        'harga_diskon',
        'keuntungan',
        'total_pembelian',
        'tanggal_beli',
    ];

    public function barang()
    {
        return $this->belongsTo(Tranksaksi::class, 'id_barang');
    }

    protected function cast():array{
        return 
        [
            'tanggal_beli' => 'date'
        ];
    }
}
