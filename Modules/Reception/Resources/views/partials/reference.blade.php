@if ($data->status == 'Pendiente')
    <span class="badge badge-info">
        {{ $data->reference }}
    </span>
@elseif($data->status == 'Registrado')
    <span class="badge badge-success">
        {{ $data->reference }}
    </span>
@elseif($data->status == 'Procesado')
    <span class="badge badge-secondary">
        {{ $data->reference }}
    </span>
@endif
