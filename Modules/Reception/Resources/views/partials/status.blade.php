@if ($data->status == 'Pendiente')
    <span class="badge badge-info">
        {{ $data->status }}
    </span>
@elseif($data->status == 'Registrado')
    <span class="badge badge-success">
        {{ $data->status }}
    </span>
@elseif($data->status == 'Procesado')
    <span class="badge badge-secondary">
        {{ $data->status }}
    </span>
@endif
