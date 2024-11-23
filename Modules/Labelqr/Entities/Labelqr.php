<?php

namespace Modules\Labelqr\Entities;

use Carbon\Carbon;
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


    public function setAmountAttribute($value) {
        $this->attributes['total_amount'] = $value;
    }

    public function getAmountAttribute($value) {
        return $value ;
    }

    public function getDateAttribute($value) {
        return Carbon::parse($value)->format('d M, Y');
    }

    public function scopeByLabelqr($query) {
        return $query->where('labelqr_id', request()->route('labelqr_id'));
    }



}
