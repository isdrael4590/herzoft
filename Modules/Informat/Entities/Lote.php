<?php

namespace Modules\Informat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lote() {
        return $this->hasMany(Informat::class, 'lote_id', 'id');
    }
}
