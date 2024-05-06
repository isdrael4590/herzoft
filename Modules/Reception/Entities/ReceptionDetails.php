<?php

namespace Modules\Reception\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Reception\Database\factories\ReceptionFactory;
use Modules\Product\Entities\Product;


class ReceptionDetails extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $with = ['product'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function reception() {
        return $this->belongsTo(Reception::class, 'reception_id', 'id');
    }
}
