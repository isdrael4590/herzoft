<?php

namespace Modules\Preparation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Preparation\Database\factories\PreparationFactory;
use Modules\Product\Entities\Product;

class Preparation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function preparationDetails() {
        return $this->hasMany(PreparationDetails::class, 'oreparation_id', 'id');
    }

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $number = Preparation::max('id') + 1;
            $model->reference = make_reference_id('ING', $number);
        });
    }

    public function getDateAttribute($value) {
        return Carbon::parse($value)->format('d M, Y');
    }


}
