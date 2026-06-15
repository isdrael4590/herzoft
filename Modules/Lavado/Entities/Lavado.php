<?php

namespace Modules\Lavado\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Reception\Entities\Reception;

class Lavado extends Model
{
    protected $guarded = [];

    protected $table = 'lavados';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $number = Lavado::count() + 1;
            $model->reference = make_reference_id('LAV', $number);
        });
    }

    public function reception()
    {
        return $this->belongsTo(Reception::class, 'reception_id', 'id');
    }

    public function lavadoDetalles()
    {
        return $this->hasMany(LavadoDetalle::class, 'lavado_id', 'id');
    }

    public function descargaLavados()
    {
        return $this->hasMany(DescargaLavado::class, 'lavado_id', 'id');
    }
}
