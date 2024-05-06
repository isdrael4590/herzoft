@foreach(\Modules\Reception\Entities\ReceptionDetails::all() as $ReceptionDetails)
<option value="{{ $ReceptionDetails->id }}">
   
    <span class="badge badge-info"> {{ $ReceptionDetails->product_name . "  ( ". $ReceptionDetails->product_code . ")  "}}
    </span>

</option>
@endforeach

