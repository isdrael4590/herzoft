
@if ($data->product_quantity == 0)
    <span class="badge badge-dark">
        {!! Carbon\Carbon::parse($data->product_expiration)->format('d M, Y') !!}
    </span>
@elseif($data->product_quantity >= 1 && $data->product_quantity <= 2)
    <span class="badge badge-warning">
        {!! Carbon\Carbon::parse($data->product_expiration)->format('d M, Y') !!}
    </span>
@elseif($data->product_quantity >= 3 && $data->product_quantity <= 4)
    <span class="badge badge-primary">
        {!! Carbon\Carbon::parse($data->product_expiration)->format('d M, Y') !!}
    </span>
@elseif($data->product_quantity >= 5)
    <span class="badge badge-success">
        {!! Carbon\Carbon::parse($data->product_expiration)->format('d M, Y') !!}
    </span>
@endif
