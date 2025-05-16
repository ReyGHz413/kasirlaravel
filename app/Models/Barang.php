<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'namabarang',
        'stok',
        'harga',
    ];

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}
