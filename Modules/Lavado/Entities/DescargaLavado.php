<?php

namespace Modules\Lavado\Entities;

use Illuminate\Database\Eloquent\Model;

class DescargaLavado extends Model
{
    protected $guarded = [];

    protected $table = 'descarga_lavado';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $number = DescargaLavado::max('id') + 1;
            $model->reference = make_reference_id('DES_LAV', $number);
        });
    }

    public function lavado()
    {
        return $this->belongsTo(Lavado::class, 'lavado_id', 'id');
    }

    public function descargaLavadoDetalles()
    {
        return $this->hasMany(DescargaLavadoDetalle::class, 'descarga_lavado_id', 'id');
    }
}
