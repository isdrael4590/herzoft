@foreach(\Modules\Discharge\Entities\DischargeDetails::all() as $DischargeDetails)

<option value="{{ $DischargeDetails->id }}">
    <span class="badge badge-info">{{ $DischargeDetails->product_name . "  ( ". $DischargeDetails->product_code . ")  "}}</span>
</option>
@endforeach

