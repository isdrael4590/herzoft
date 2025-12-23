<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Entities\Product;



class Instrumental extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'codigo_unico_ud',
        'nombre_generico',
        'tipo_familia',
        'marca_fabricante',
        'fecha_compra',
        'estado_actual',
    ];

    protected $casts = [
        'fecha_compra' => 'date',
    ];

    // Relación con el producto principal
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
