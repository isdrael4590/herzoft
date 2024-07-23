@if ($data->product_state_preparation == 'Disponible')
    <span class="badge badge-success">
        {{ $data->product_state_preparation }}
    </span>
@elseif($data->product_state_preparation == 'Procesado')
    <span class="badge badge-info">
        {{ $data->product_state_preparation }}    </span>
@endif