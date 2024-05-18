<?php

namespace Modules\Stock\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function stockDetails() {
        return $this->hasMany(StockDetails::class, 'stock_id', 'id');
    }
    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $number = Stock::max('id') + 1;
            $model->reference = make_reference_id(' STOCK', $number);
        });
    }
}
