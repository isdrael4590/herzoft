@foreach(\Modules\Preparation\Entities\PreparationDetails::all() as $PreparationDetails)
<option value="{{ $PreparationDetails->id }}">
   
    <span class="badge badge-info"> {{ $PreparationDetails->product_name . "  ( ". $PreparationDetails->product_code . ")  "}}
    </span>

</option>
@endforeach

@if ($data->product_coming_zone == 'Zona Esteril')
    <span class="badge badge-warning">
        {{ $data->product_coming_zone }}
    </span>
@elseif($data->product_coming_zone == 'Recepcion')
    <span class="badge badge-primary">
        {{ $data->product_coming_zone }}
    </span>
@endif