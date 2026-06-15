<?php

namespace Modules\Stock\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class StockQuantityReset extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_detail_id',
        'user_id',
        'previous_quantity',
        'new_quantity',
        'product_name',
        'product_code',
        'product_area',
        'product_package_wrap',
        'reset_at',
    ];

    protected $casts = [
        'reset_at' => 'datetime',
    ];

    public function stockDetail()
    {
        return $this->belongsTo(StockDetails::class, 'stock_detail_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
