
@foreach(\Modules\Preparation\Entities\PreparationDetails::all() as  $PreparationDetails)
<option value="{{ $PreparationDetails->id }}">

    @if ($PreparationDetails->product_state_preparation == 'Disponible')
    <span class="badge badge-success">
        {{ $PreparationDetails->product_state_preparation }}
    </span>
@elseif($PreparationDetails->product_state_preparation == 'Procesado')
    <span class="badge badge-primary">
        {{ $PreparationDetails->product_state_preparation }}
    </span>
@endif


</option>
@endforeach