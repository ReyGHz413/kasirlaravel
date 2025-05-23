<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use App\Models\Nota;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
class DetailNota extends Model
{
    protected $fillable = [
        'nota_id', 'barang_id', 'jumlah', 'diskon',
        'harga_asli', 'harga_diskon',  'subtotal'
    ];
 public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function nota() {
        return $this->belongsTo(Nota::class);
    }
    
}
