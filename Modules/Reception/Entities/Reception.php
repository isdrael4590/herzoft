<?php

namespace Modules\Reception\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Reception\Database\factories\ReceptionFactory;
use Modules\Product\Entities\Product;

class Reception extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function receptionDetails()
    {
        return $this->hasMany(ReceptionDetails::class, 'reception_id', 'id');
    }

    public function getDetailsCountAttribute()
{
    return $this->receptionDetails()->count();
}

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $number = Reception::max('id') + 1;
            $model->reference = make_reference_id('ING', $number);
        });
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d M, Y');
    }
}
