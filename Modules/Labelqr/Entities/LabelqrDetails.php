<?php

namespace Modules\Labelqr\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Discharge\Entities\DischargeDetails;
use Modules\Preparation\Entities\PreparationDetails;
use Modules\Product\Entities\Product;


class LabelqrDetails extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $with = ['product'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function labelqr()
    {
        return $this->belongsTo(Labelqr::class, 'labelqr_id', 'id');
    }


    public function labelqrtodischarge()
    {
        return $this->has(DischargeDetails::class, 'discharge_detail_id', 'id');
    }

    public function preparationtolabelqr()
    {
        return $this->belongsTo(PreparationDetails::class, 'product_id', 'id');
    }
}
