<?php

namespace Modules\Preparation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class PreparationQuantityReset extends Model
{
    use HasFactory;

    protected $fillable = [
        'preparation_detail_id',
        'user_id',
        'previous_quantity',
        'new_quantity',
        'product_name',
        'product_code',
        'product_area',
        'product_type_process',
        'reset_at',
    ];

    protected $casts = [
        'reset_at' => 'datetime',
    ];

    // Relaciones
    public function preparationDetail()
    {
        return $this->belongsTo(PreparationDetails::class, 'preparation_detail_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}