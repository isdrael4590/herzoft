@if ($data->product_status_stock == 'Disponible')
    <span class="badge badge-success">
        {{ $data->product_status_stock }}
    </span>
@elseif($data->product_status_stock == 'No Disponible')
    <span class="badge badge-danger">
        {{ $data->product_status_stock }}    </span>
@endif
