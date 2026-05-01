<?php

namespace Modules\Lavado\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\Reception\Entities\Reception;

class PrelavadoDetalle extends Model
{
    protected $guarded = [];

    protected $table = 'prelavado_detalles';

    public function reception()
    {
        return $this->belongsTo(Reception::class, 'reception_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
