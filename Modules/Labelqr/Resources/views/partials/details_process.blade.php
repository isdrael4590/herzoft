@foreach(\Modules\Labelqr\Entities\LabelqrDetails::all() as $LabelqrDetails)

<option value="{{ $LabelqrDetails->id }}">
    <span class="badge badge-info">{{ $LabelqrDetails->product_name . "  ( ". $LabelqrDetails->product_code . ")  "}}</span>
</option>
@endforeach

