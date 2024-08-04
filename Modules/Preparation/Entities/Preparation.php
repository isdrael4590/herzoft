<?php

namespace Modules\Preparation\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Preparation\Database\factories\PreparationFactory;
use Modules\Product\Entities\Product;
use Modules\Reception\Entities\Reception;

class Preparation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function preparationDetails() {
        return $this->hasMany(PreparationDetails::class, 'preparation_id', 'id');
    }

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $number = Preparation::max('id') + 1;
            $model->reference = make_reference_id('PRE', $number);
        });
    }

    public function getDateAttribute($value) {
        return Carbon::parse($value)->format('d M, Y');
    }


    public function ReceptiontoPreparation() {
        return $this->hasMany(Reception::class, 'reception_id', 'id');
    }

}
