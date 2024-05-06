<?php

namespace Modules\Discharge\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discharge extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dischargeDetails() {
        return $this->hasMany(DischargeDetails::class, 'discharge_id', 'id');
    }



    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $number = Discharge::max('id') + 1;
            $model->reference = make_reference_id('DES', $number);
        });
    }

    public function scopeCompleted($query) {
        return $query->where('status', 'Completed');
    }

 
}
