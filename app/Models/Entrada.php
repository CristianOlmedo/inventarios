<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $fillable = [
        'producto_id',
        'cantidad',
        'precio_compra',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
