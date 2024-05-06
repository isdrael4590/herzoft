<?php

namespace Modules\Informat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Machine extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function informats() {
        return $this->hasMany(Informat::class, 'machine_id', 'id');
    }
}
