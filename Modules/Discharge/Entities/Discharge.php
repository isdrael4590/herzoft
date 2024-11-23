<?php

namespace Modules\Discharge\Entities;

use Carbon\Carbon;
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

 






    public function discharge() {
        return $this->hasMany(Discharge::class, 'discharge_id', 'id');
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

    public function scopeByDischarge($query) {
        return $query->where('discharge_id', request()->route('discharge_id'));
    }




    
}
