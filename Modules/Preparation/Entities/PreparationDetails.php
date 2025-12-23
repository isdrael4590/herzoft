<?php

namespace Modules\Preparation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Discharge\Entities\Discharge;
use Modules\Product\Entities\Product;


class PreparationDetails extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $with = ['product'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function preparation()
    {
        return $this->belongsTo(Preparation::class, 'preparation_id', 'id');
    }

    // Agregar relación
    public function quantityResets()
    {
        return $this->hasMany(PreparationQuantityReset::class, 'preparation_detail_id');
    }
}
