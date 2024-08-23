<?php

namespace Modules\Labelqr\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Labelqr\Database\factories\LabelqrFactory;
use Modules\Product\Entities\Product;

class Labelqr extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function labelqrDetails() {
        return $this->hasMany(LabelqrDetails::class, 'labelqr_id', 'id');
    }

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $number = Labelqr::max('id') + 1;
            $model->reference = make_reference_id(' Proceso', $number);
        });
    }

    public function labelqr() {
        return $this->hasMany(Labelqr::class, 'labelqr_id', 'id');
    }


}
