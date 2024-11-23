

@if ($data->product_quantity == 0)
    <span class="badge badge-dark">
        {{ $data->product_coming_zone }}
    </span>
@elseif($data->product_quantity >= 1 && $data->product_quantity <= 2)
    <span class="badge badge-warning">
        {{ $data->product_coming_zone }} </span>
@elseif($data->product_quantity >= 3 && $data->product_quantity <= 4)
    <span class="badge badge-primary">
        {{ $data->product_coming_zone }} </span>
@elseif($data->product_quantity >= 5)
    <span class="badge badge-success">
        {{ $data->product_coming_zone }} </span>
@endif