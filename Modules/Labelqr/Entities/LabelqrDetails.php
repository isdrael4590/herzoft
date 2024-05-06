<?php

namespace Modules\Labelqr\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Labelqr\Database\factories\LabelqrFactory;
use Modules\Product\Entities\Product;


class LabelqrDetails extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $with = ['product'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function labelqr() {
        return $this->belongsTo(Labelqr::class, 'labelqr_id', 'id');
    }
}
