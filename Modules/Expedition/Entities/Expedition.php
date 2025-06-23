<?php

namespace Modules\Expedition\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Expedition extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ExpeditionDetails()
    {
        return $this->hasMany(ExpeditionDetails::class, 'expedition_id', 'id');
    }

    public function getDetailsCountAttribute()
    {
        return $this->ExpeditionDetails()->count();
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $number = Expedition::max('id') + 1;
            $model->reference = make_reference_id('EXP', $number);
        });
    }

    public function Expedition()
    {
        return $this->hasMany(Expedition::class, 'expedition_id', 'id');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'Completed');
    }
}
