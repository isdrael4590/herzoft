<?php

namespace Modules\Lavado\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;

class DescargaLavadoDetalle extends Model
{
    protected $guarded = [];

    protected $table = 'descarga_lavado_detalles';

    public function descargaLavado()
    {
        return $this->belongsTo(DescargaLavado::class, 'descarga_lavado_id', 'id');
    }

    public function lavadoDetalle()
    {
        return $this->belongsTo(LavadoDetalle::class, 'lavado_detalle_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
