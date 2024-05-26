@if ($data->product_state_preparation == 'Disponible')
    <span class="badge badge-success">
        {{ $data->status }}
    </span>
@elseif($data->product_state_preparation == 'Procesado')
    <span class="badge badge-primary">
        {{ $data->status }}
    </span>
@endif
