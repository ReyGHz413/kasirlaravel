<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailNota;
use App\Models\Nota;
class Barang extends Model
{
protected $fillable = ['namabarang', 'stok', 'harga', 'diskon'];

    public function nota()
    {
        return $this->hasMany(Nota::class);
    }
    public function detailnota() {
        return $this->hasMany(DetailNota::class);
    }
}
