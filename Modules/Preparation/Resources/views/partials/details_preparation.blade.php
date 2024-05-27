
@foreach(\Modules\Preparation\Entities\PreparationDetails::all() as  $PreparationDetails)
<option value="{{ $PreparationDetails->id }}">
    <span class="badge badge-info"> {{ $PreparationDetails->product_name . "  ( ". $PreparationDetails->product_coming_zone . ")  "}}
    </span>

</option>
@endforeach
