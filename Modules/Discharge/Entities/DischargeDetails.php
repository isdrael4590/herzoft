<?php

namespace Modules\Discharge\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Entities\Product;

class DischargeDetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['product'];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function discharge() {
        return $this->belongsTo(Discharge::class, 'discharge_id', 'id');
    }

   
}
