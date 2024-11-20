<?php

namespace Modules\Expedition\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Stock\Entities\StockDetails;
use Modules\Product\Entities\Product;


class ExpeditionDetails extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $with = ['product'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function Expedition()
    {
        return $this->belongsTo(Expedition::class, 'expedition_id', 'id');
    }



    public function stock_detail() {
        return $this->belongsTo(StockDetails::class, 'stock_detail_id', 'id');
    }
}
