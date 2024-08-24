@if ($data->product_state_preparation == 'Disponible')
    <span class="badge badge-success">
        {{ $data->product_coming_zone }}
    </span>
@elseif($data->product_state_preparation == 'Procesado')
    <span class="badge badge-info">
        {{ $data->product_coming_zone }} </span>
@elseif($data->product_state_preparation == 'Reprocesar')
    <span class="badge badge-warning">
        {{ $data->product_coming_zone }} </span>
@endif
