<?php

namespace Modules\Discharge\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Entities\Product;
use Modules\Labelqr\Entities\LabelqrDetails;
use Modules\Preparation\Entities\PreparationDetails;

class DischargeDetails extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['dischargelabelqr','product'];
    protected $table = 'discharge_details';

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function discharge() {
        return $this->belongsTo(Discharge::class, 'discharge_id', 'id');
    }

   public function dischargelabelqr() {
        return $this->belongsTo(LabelqrDetails::class, 'labelqr_detail_id', 'id');
    }
   
    public function dischargepreparation() {
        return $this->belongsTo(PreparationDetails::class, 'preparation_detail_id', 'id');
    }
}
