<?php

namespace Modules\Lavado\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;

class LavadoDetalle extends Model
{
    protected $guarded = [];

    protected $table = 'lavado_detalles';

    public function lavado()
    {
        return $this->belongsTo(Lavado::class, 'lavado_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
