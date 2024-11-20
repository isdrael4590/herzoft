@if ($data->product_quantity >= 1)
    <span class="badge badge-success">
        {!! Carbon\Carbon::parse($data->product_expiration)->format('d M, Y') !!}
    </span>
@else
    <span class="badge badge-dark">
        {!! Carbon\Carbon::parse($data->product_expiration)->format('d M, Y') !!}
    </span>
@endif
