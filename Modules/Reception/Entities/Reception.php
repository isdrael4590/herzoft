<?php

namespace Modules\Reception\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;
use Modules\Reception\Database\factories\ReceptionFactory;
use Modules\Lavado\Entities\PrelavadoDetalle;
use Modules\Product\Entities\Product;

class Reception extends Model
{
    use HasFactory, Searchable;
    protected $guarded = [];

    public function searchableAs(): string
    {
        return 'receptions';
    }

    public function toSearchableArray(): array
    {
        $this->loadMissing('receptionDetails');

        return [
            'id'                  => $this->id,
            'reference'           => $this->reference ?? '',
            'area'                => (string) ($this->area ?? ''),
            'status'              => $this->status ?? '',
            'delivery_staff'      => $this->delivery_staff ?? '',
            'operator'            => $this->operator ?? '',
            'updated_at_timestamp'=> $this->updated_at?->timestamp ?? 0,
            'updated_at_date'     => $this->updated_at?->format('Y-m-d') ?? '',
            'product_names'       => $this->receptionDetails->pluck('product_name')->filter()->implode(' '),
            'product_codes'       => $this->receptionDetails->pluck('product_code')->filter()->implode(' '),
        ];
    }

    public function shouldBeSearchable(): bool
    {
        return true;
    }

    public function receptionDetails()
    {
        return $this->hasMany(ReceptionDetails::class, 'reception_id', 'id');
    }

    public function prelavadoDetalles()
    {
        return $this->hasMany(PrelavadoDetalle::class, 'reception_id', 'id');
    }

    public function getDetailsCountAttribute()
{
    return $this->receptionDetails()->count();
}

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $number = Reception::max('id') + 1;
            $model->reference = make_reference_id('ING', $number);
        });
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d M, Y');
    }
}
